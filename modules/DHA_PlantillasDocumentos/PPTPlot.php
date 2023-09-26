<?php

require_once 'custom/include/phplot/phplot.php';
require_once ('custom/include/PHPPresentation/vendor/autoload.php');
use PhpOffice\PhpPresentation\Autoloader;
use PhpOffice\PhpPresentation\IOFactory;
use PhpOffice\PhpPresentation\Slide;
use PhpOffice\PhpPresentation\Slide\Animation;
use PhpOffice\PhpPresentation\Shape\Drawing;
use PhpOffice\PhpPresentation\Shape\Group;
use PhpOffice\PhpPresentation\Shape\RichText;
use PhpOffice\PhpPresentation\Shape\RichText\BreakElement;
use PhpOffice\PhpPresentation\Shape\RichText\TextElement;
use PhpOffice\PhpPresentation\Shape\Line;
use PhpOffice\PhpPresentation\Style\Alignment;
use PhpOffice\PhpPresentation\Style\Bullet;
use PhpOffice\PhpPresentation\Style\Color;
use PhpOffice\PhpPresentation\Style\Fill;
use PhpOffice\PhpPresentation\Style\Border;

class PPTPlot extends phplot {
	
	static protected $plots = array(
        'stackedbarstitle' => array(
			'draw_method' => 'DrawStackedBarsTitle',
			'sum_vals' => TRUE,
			// 'suppress_axes' => TRUE,
		),
    );
	
	public $current_slide;
	private $shapes =  array();
	/**
     * Selects the type of plot - how the data will be graphed
     *
     * @param string $which_pt  The plot type, such as bars, lines, pie, ...
     * @return bool  True (False on error if an error handler returns True)
     */
    function SetPlotType($which_pt)
    {
        $avail_plot_types = implode(', ', array_keys(self::$plots)); // List of known plot types
        $this->plot_type = $this->CheckOption($which_pt, $avail_plot_types, __FUNCTION__);
        return (boolean)$this->plot_type;
    }
	
	/**
     * Selects the type of plot - how the data will be graphed
     *
     * @param string $which_pt  The plot type, such as bars, lines, pie, ...
     * @return bool  True (False on error if an error handler returns True)
     */
    function SetCurrentSlide(&$CurrentSlide)
    {
        $this->current_slide = $CurrentSlide;
        return TRUE;
    }
	
	/**
     * Draws the current graph onto the image
     *
     * This is the function that performs the actual drawing, after all the
     * parameters and data are set up. It also outputs the finished image,
     * unless told not to with SetPrintImage(False).
     * Note: It is possible for this to be called multiple times (multi-plot).
     *
     * @return bool  True (False on error if an error handler returns True)
     */
    function DrawGraphPPT()
    {
         // Test for missing image, missing data, empty data:
        if (!$this->CheckDataArray())
            return FALSE; // Error message already reported.

        // Load some configuration values from the array of plot types:
        $pt = &self::$plots[$this->plot_type]; // Use reference for shortcut
        $draw_method = $pt['draw_method'];
        $draw_arg = isset($pt['draw_arg']) ? $pt['draw_arg'] : array();
        $draw_axes = empty($pt['suppress_axes']);

        // Allocate colors for the plot:
        $this->SetColorIndexes();

        // Calculate scaling, but only for plots with axes (excludes pie charts).
        if ($draw_axes) {

            // Get maxima and minima for scaling:
            // if (!$this->FindDataLimits())
                // return FALSE;

            // Set plot area world values (plot_max_x, etc.):
            if (!$this->CalcPlotAreaWorld())
                return FALSE;

            // Calculate X and Y axis positions in World Coordinates:
            // $this->CalcAxisPositions();

            // Process label-related parameters:
            $this->CheckLabels();
        }

        // Calculate the plot margins, if needed.
        // For pie charts, set the $maximize argument to maximize space usage.
        $this->CalcMargins(!$draw_axes);

        // Calculate the actual plot area in device coordinates:
        $this->CalcPlotAreaPixels();

        // Calculate the mapping between world and device coordinates:
        if ($draw_axes) $this->CalcTranslation();

        call_user_func_array(array($this, $draw_method), $draw_arg);

        if ($this->print_image && !$this->PrintImage())
            return FALSE;

        return TRUE;
    
    }
	
	protected function CalcBarWidths($stacked, $verticals)
    {
        // group_width is the width of a group, including padding
        if ($verticals) {
            $group_width = $this->plot_area_width / $this->num_data_rows;
        } else {
            $group_width = $this->plot_area_height / $this->num_data_rows;
        }

        // Number of bar spaces in the group, including actual bars and bar_extra_space extra:
        if ($stacked) {
            $num_spots = 1 + $this->bar_extra_space;
        } else {
            $num_spots = $this->data_columns + $this->bar_extra_space;
        }

        // record_bar_width is the width of each bar's allocated area.
        // If bar_width_adjust=1 this is the width of the bar, otherwise
        // the bar is centered inside record_bar_width.
        // The equation is:
        //   group_frac_width * group_width = record_bar_width * num_spots
        $this->record_bar_width = 1;//$this->group_frac_width * $group_width / $num_spots;

        // Note that the extra space due to group_frac_width and bar_extra_space will be
        // evenly divided on each side of the group: the drawn bars are centered in the group.

        // Within each bar's allocated space, if bar_width_adjust=1 the bar fills the
        // space, otherwise it is centered.
        // This is the actual drawn bar width:
        $this->actual_bar_width = 1;//$this->record_bar_width * $this->bar_width_adjust;
        // This is the gap on each side of the bar (0 if bar_width_adjust=1):
        $this->bar_adjust_gap = ($this->record_bar_width - $this->actual_bar_width) / 2;

        if ($this->GetCallback('debug_scale')) {
            $this->DoCallback('debug_scale', __FUNCTION__, array(
                'record_bar_width' => $this->record_bar_width,
                'actual_bar_width' => $this->actual_bar_width,
                'bar_adjust_gap' => $this->bar_adjust_gap));
        }
        return TRUE;
    }
	
	
	
	/**
     * Draws a stackedbars plot (Stacked Bar chart Title)
     *
     * This is the main function for drawing a stackedbars plot.  Supported
     * data types are text-data, for vertical plots, and text-data-yx, for
     * horizontal plots (for which it calls DrawHorizStackedBars()).
     * Original stacked bars idea by Laurent Kruk < lolok at users.sourceforge.net >
     *
     * @return bool  True (False on error if an error handler returns True)
     */
    function DrawStackedBarsTitle()
    {
        if (!$this->CheckDataType('text-data, text-data-yx'))
            return FALSE;
        if ($this->datatype_swapped_xy)
            return $this->DrawHorizStackedBars();
        $this->CalcBarWidths(TRUE, TRUE); // Calculate bar widths for stacked, vertical

        // This is the X offset from the bar's label center point to the left side of the bar.
        $x_first_bar = $this->record_bar_width / 2 - $this->bar_adjust_gap;

        $gcvars = array(); // For GetBarColors, which initializes and uses this.

        // Determine if any data labels are on:
        $data_labels_within = ($this->y_data_label_pos == 'plotstack');
        $data_labels_end = $data_labels_within || ($this->y_data_label_pos == 'plotin');
        $data_label_y_offset = -5 - $this->shading; // For upward labels only.
		$this->shapes = array();
		///$oAnimation2 = new Animation();
        for ($row = 0; $row < $this->num_data_rows; $row++) {
            $record = 1;                                    // Skip record #0 (data label)

            $x_now_pixels = $this->xtr(0.5 + $row);         // Place text-data at X = 0.5, 1.5, 2.5, etc...

            if ($this->x_data_label_pos != 'none')          // Draw X Data labels?
                $this->DrawXDataLabel($this->data[$row][0], $x_now_pixels, $row);

            // Determine bar direction based on 1st non-zero value. Note the bar direction is
            // based on zero, not the axis value.
            $n_recs = $this->num_recs[$row];
            $upward = TRUE; // Initialize this for the case of all segments = 0
            for ($i = $record; $i < $n_recs; $i++) {
                if (is_numeric($this_y = $this->data[$row][$i]['value']) && $this_y != 0) {
                    $upward = ($this_y > 0);
                    break;
                }
            }

            $x1 = $x_now_pixels - $x_first_bar;  // Left X of bars in this stack
            $x2 = $x1 + $this->actual_bar_width; // Right X of bars in this stack
            $wy1 = 0;                            // World coordinates Y1, current sum of values
            $wy2 = $this->x_axis_position;       // World coordinates Y2, last drawn value

            // Draw bar segments and labels in this stack.
            $first = TRUE;
            for ($idx = 0; $record < $n_recs; $record++, $idx++) {

                // Skip missing Y values. Process Y=0 values due to special case of moved axis.
                if (is_numeric($this_y = $this->data[$row][$record]['value'])) {

                    $wy1 += $this_y;    // Keep the running total for this bar stack

                    // Draw the segment only if it will increase the stack height (ignore if wrong direction):
                    if (($upward && $wy1 > $wy2) || (!$upward && $wy2 > $wy1)) {
                        $y1 = $this->ytr($wy1); // Convert to device coordinates. $y1 is outermost value.

                        $y2 = $this->ytr($wy2); // $y2 is innermost (closest to axis).

                        // Select the colors:
                        //$this->GetBarColors($row, $idx, $gcvars, $data_color, $shade_color, $border_color);

                        // Draw the bar, and the shade or border:
						 // print"<pre>";print_r(array($row, $idx, $x1, $y1, $x2, $y2,
                            // $data_color, false, $border_color,
                            // // Only shade the top for upward bars, or the first segment of downward bars:
                            // $upward || $first, true));die;
							$line = new Line($x1, $y1, $x1, $y2);
							$line->getBorder()->setLineWidth(3);
							$this->current_slide->addShape($line);
							$this->shapes[] = $line;
							//$oAnimation2->addShape($line);
							
							
                        // $this->DrawBar($row, $idx, $x1, $y1, $x2, $y2,
                            // $data_color, false, $border_color,
                            // // Only shade the top for upward bars, or the first segment of downward bars:
                            // $upward || $first, true);

                        // Draw optional data label for this bar segment just inside the end.
                        // Text value is the current Y, but position is the cumulative Y.
                        // The label is only drawn if it fits in the segment height |y2-y1|.
                        if ($data_labels_within) {
                            $dvl['min_height'] = abs($y1 - $y2);
                            if ($upward) {
                                $dvl['v_align'] = 'top';
                                $dvl['y_offset'] = 3;
                            } else {
                                $dvl['v_align'] = 'bottom';
                                $dvl['y_offset'] = -3;
                            }
                            $this->DrawDataValueLabelPPT('y', $row, $idx, $row+0.5, $wy1, $this->data[$row][$record]['title'], $dvl);
                        }
                        // Mark the new end of the bar, conditional on segment height > 0.
                        $wy2 = $wy1;
                        $first = FALSE;
                    }
                }
            }   // end for
        }// end for
		
		$this->createAnimation();
        return TRUE;
    }
	
	function DrawDataValueLabelPPT($x_or_y, $row, $column, $x_world, $y_world, $text, $dvl){
		
		if ($x_or_y == 'x') {
            $angle = $this->x_data_label_angle;
            $font_id = 'x_label';
            $formatted_text = $this->FormatLabel('xd', $text, $row, $column);
        } else { // Assumed 'y'
            $angle = $this->y_data_label_angle;
            $font_id = 'y_label';
            $formatted_text = $this->FormatLabel('yd', $text, $row, $column);
        }
        // Assign defaults and then extract control variables from $dvl:
        $x_offset = $y_offset = 0;
        $h_align = $v_align = 'center';
        extract($dvl);	
		
        // Check to see if the text fits in the available space, if requested.
        if (isset($min_width) || isset($min_height)) {
            list($width, $height) = $this->SizeText($font_id, $angle, $formatted_text);
            if ((isset($min_width) && ($min_width - $width)  < 2)
                || (isset($min_height) && ($min_height - $height) < 2))
               return FALSE;
        }
		$X = ($this->xtr($x_world) + $x_offset) - ($width );
		$Y = $this->ytr($y_world) + $y_offset;
		
		 // print"<pre>";print_r(array($X,$Y,$width));die;
		// $font_id, $angle, $this->xtr($x_world) + $x_offset, $this->ytr($y_world) + $y_offset,
                        // $this->ndx_dvlabel_color, $formatted_text, $h_align, $v_align
		$oShapeRichText = new RichText();
		$oShapeRichText->setHeight($height * 2)
			->setWidth($width * 2)
			->setOffsetX($X)
			->setOffsetY($Y);
		$oShapeRichText->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_CENTER );
		$textRun = $oShapeRichText->createTextRun($text);
		$textRun->getFont()->setBold(true)
			->setSize(12)
			->setColor( new Color( 'FF000000' ) );
			
		$oShapeRichText->getFill()
			->setFillType(Fill::FILL_SOLID)
			->setStartColor(new Color('FFFFFFFF'))
			->setEndColor(new Color('FFFFFFFF'));
		$this->current_slide->addShape($oShapeRichText);
		$this->shapes[] = $oShapeRichText;
		// $oAnimation2 = new Animation();
		// $oAnimation2->addShape($oShapeRichText);
		// $this->current_slide->addAnimation($oAnimation2);
	}
	
	function createAnimation(){
		$shape_size = sizeof($this->shapes)  - 1;
		$oAnimation1 = new Animation();
		//print"<pre>";print_r($this->shapes);
		for ($idx = $shape_size; $idx >= 0 ; $idx--) {
			// $this->current_slide->addShape($this->shapes[$idx]);
			$oAnimation1->addShape($this->shapes[$idx]);
		}
			$this->current_slide->addAnimation($oAnimation1);
		//die;
	}
}