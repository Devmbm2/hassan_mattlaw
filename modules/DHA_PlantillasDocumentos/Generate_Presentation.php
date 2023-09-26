<?php
 ini_set('display_errors', 0);
 ini_set('display_startup_errors', 0);
// error_reporting(E_ALL);
require_once 'modules/DHA_PlantillasDocumentos/PPTPlot.php';
require_once ('custom/include/PHPPresentation/vendor/autoload.php');


use PhpOffice\PhpPresentation\Autoloader;
use PhpOffice\PhpPresentation\IOFactory;
use PhpOffice\PhpPresentation\Slide;
use PhpOffice\PhpPresentation\PhpPresentation;
use PhpOffice\PhpPresentation\AbstractShape;
use PhpOffice\PhpPresentation\DocumentLayout;
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

$graph_label;

function mycallback($index)
{
	global $graph_label;
	return $graph_label[$index];
}

class PHPPresentationGraph {
	
	
	private $pie_slices;
	private $base_angle;
	private $data;
	private $module;
	private $selected_ids;
	private $percent_total;
	private $Download;
	private $graph_colors;
	private $graph_index;
	private $writers;
	
	public function __construct($module,$ids, $Download = true){
		$this->pie_slices = 20;
		$this->base_angle = 90;
		$this->module = $module;
		$this->selected_ids = $ids;
		$this->Download = $Download;
		$this->graph_colors = array();
		$this->graph_index = 0;
		$this->writers = array('PowerPoint2007' => 'pptx');
	}
	# This callback is used to label each plot with a title.
	# The x_title font is set below and used here.
	function draw_plot_title($img, $args)
	{
		list($plot, $x, $y, $title) = $args;
		$text_color = imagecolorresolve($img, 0, 0, 0);
		$plot->DrawText('x_title', 0, $x, $y, $text_color, $title, 'center', 'top');
	}
	
	# Produce one plot tile
	function draw_plot($plot, $direction, $xbase, $ybase)
	{
		$plot->SetPieStartAngle($this->base_angle);
		$plot->SetPieDirection($direction);
		$plot->SetPlotAreaPixels($xbase, $ybase, $xbase + 400, $ybase + 400);
		//$title = "Start @{$start_angle}d $direction";
		$plot->SetCallback('draw_all', 'draw_plot_title',
					  array($plot, $xbase + 100, $ybase + 200, $title));
		$plot->DrawGraph();
	}
	
	function draw_graph_bar_chart($data,$file_name, $graph_label, $x_count,&$currentSlide){
		
		$plot = new PPTPlot(950, 650, $file_name);
		$plot->SetDataValues($data);
		$plot->SetDataType('text-data');
		$plot->SetPlotType('stackedbarstitle');
		$plot->SetShading(0);
		$plot->SetImageBorderType('plain');
		$n_data = $this->count_data_sets($data, 'text-data');
		$colors = $this->color_range($plot->SetRGBColor('blue'),
		$plot->SetRGBColor('blue'), $n_data);
		$plot->SetDataColors($colors);
		//$plot->SetLabelScalePosition(1);
		$plot->SetPieLabelType('index', 'custom', 'mycallback');
		$plot->SetYDataLabelPos('plotstack');
		$plot->SetCurrentSlide($currentSlide);
		//$plot->SetYTickIncrement(1);
		//$plot->SetXTickLabelPos(0.5);
		//$plot->SetXTickLabelPos(0.5);
		//$plot->SetXTickPos(0.5);
		/* $plot->SetXTickLabelPos('none');
		$plot->SetXTickPos('none'); */
		// foreach($graph_label as $key => $value){
			// $plot->SetTitle($value);			
		// }
		$plot->SetPlotAreaWorld(0, 0, $x_count, 10);
		//$plot->SetYTitle('No Of Hours');
		$plot->SetIsInline(true);
		$plot->DrawGraphPPT();
		// $this->draw_plot($plot, 'CW',  100, 100);
	}
	
	function draw_graph_pie_chart($data,$file_name){
		# Make a data array with equal-size slices:
		$percent_remaining =  100 - $this->percent_total;
		if($percent_remaining > 0){
			$data[] = array('remaining',$percent_remaining);
			$this->graph_colors[] = '#ffffff';
			
		}
		$plot = new PHPlot(960, 715,$file_name);
		$plot->SetDataValues($data);
		$plot->SetDataType('text-data-single');
		$plot->SetPlotType('pie');
		$plot->SetShading(0);
		$plot->SetDataColors($this->graph_colors);
		$plot->SetImageBorderType('plain');
		$plot->SetLabelScalePosition(0.5);
		$plot->SetPieLabelType('index', 'custom', 'mycallback');
		$plot->SetYDataLabelPos('none');
		$plot->data_value_label_angle = 45;
		$plot->SetIsInline(true);
		$this->draw_plot($plot, 'CW',  100, 100);
	}
	//////////////////////////////////////////////////////////////////////////////
	function generatePresentationBarChart(){
		global $sugar_config, $graph_label, $timedate;
				
		// Create new PHPPresentation object
		$objPHPPresentation = new PhpPresentation();
		$events_relation = 'ht_case_event_cases';
		foreach($this->selected_ids as $record_id){
			$bean = BeanFactory::getBean($this->module, $record_id);
			if($bean->load_relationship($events_relation)){
				$related_beans = $bean->$events_relation->getBeans(array('order_by' => 'event_date,ASC'));
				$graph_data = array();
				$graph_label = array();
				$this->last_plotted_bar = 0;
				$plotted_diff = array();
				$tmp_img_files = array();
				$query = "SELECT  COUNT(DISTINCT DATE(event_date)) AS x_count FROM `ht_case_event` e
					INNER JOIN `ht_case_event_cases_c` ce ON ce.ht_case_event_casesht_case_event_idb = e.id
					WHERE ht_case_event_casescases_ida = '{$record_id}'
				";
				$result = $bean->db->query($query);
				$x_count = $bean->db->fetchByAssoc($result)['x_count'];
					
				foreach ($related_beans as $event) {
					$start_data = explode(' ',$event->event_date);
					$value = date("H", strtotime($start_data[1]) - $plotted_diff[$start_data[0]]);
					$start_data = explode(' ',$event->event_date);
					$data[$start_data[0]][$start_data[0]] = $start_data[0];
					$event_title =  $event->name." \n ".date("M d h:i A", strtotime($event->event_date));
					if($event->event_picture){
						$file_name_image = "upload/{$event->id}_event_picture";
						$tmp_img_files[] = $copy_image = "tmp_img_files/{$event->id}_event_picture_{$event->event_picture}";
						
						if(file_exists($file_name_image)){
							copy($file_name_image, $copy_image);
							//$cur = $this->createTemplatedSlide($objPHPPresentation, $file_name_image);
							$oSlide2 = $objPHPPresentation->createSlide();
							
							$this->getImageTitle($oSlide2, $event_title);
							$oImage = new Drawing\File();
							$oImage->setPath($copy_image);
							$oImage->setHeight(400);
							// $oImage->setWidth(50);
							$oImage->setOffsetX(150);
							$oImage->setOffsetY(210);
							$oSlide2->addShape($oImage);  
						}
					}
					
					$data[$start_data[0]][] =  array(
						'value' => $value,
						'title' => $event_title,
						'description' => 'description '.$value,
					);
					
					$plotted_diff[$start_data[0]] = strtotime($start_data[1]);
					$graph_data = array_values($data);
					$graph_label[] =  $event->name . " at " . $event->event_date;
					$this->graph_colors[$this->graph_index] = $this->getRandomColor();
					$file_name = 'document_templates/'.$event->id.'.png';
					$currentSlide = $objPHPPresentation->createSlide();
					$this->draw_graph_bar_chart($graph_data, $file_name, $graph_label,$x_count, $currentSlide);
					// $currentSlide = $this->createTemplatedSlide($objPHPPresentation,$file_name);
					$this->graph_index++;
				}
			}
			$objPHPPresentation->removeSlideByIndex(0);
			return $this->generatePresentation($objPHPPresentation,$bean,'Bar Chart');
		}
	}
	function getImageTitle(&$cur_slide, $event_title){
		
		$oShapeRichText = new RichText();
		$oShapeRichText->setHeight(150)
			->setWidth(500)
			->setOffsetX(200)
			->setOffsetY(40);
		$oShapeRichText->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_CENTER );
		$textRun = $oShapeRichText->createTextRun($event_title);
		$textRun->getFont()->setBold(true)
			->setSize(40)
			->setColor( new Color( 'FFFFFFFF' ) );
			
		$oShapeRichText->getFill()
			->setFillType(Fill::FILL_SOLID)
			->setStartColor(new Color('FF000080'))
			->setEndColor(new Color('FF000080'));
		ob_clean();
		$cur_slide->addShape($oShapeRichText);
		
	}
	function generatePresentationPieChart(){
		global $sugar_config, $graph_label, $timedate;
		
				
		// Create new PHPPresentation object
		$objPHPPresentation = new PhpPresentation();
		$events_relation = 'ht_case_event_cases';
		foreach($this->selected_ids as $record_id){
			$bean = BeanFactory::getBean($this->module, $record_id);
			if($bean->load_relationship($events_relation)){
				$related_beans = $bean->$events_relation->getBeans(array('order_by' => 'event_date,ASC'));
				$first = reset($related_beans)->event_date ;
				$last = end($related_beans)->event_date;
				$first = (is_string($first) ? strtotime($first) : $first);
				$last = (is_string($last) ? strtotime($last) : $last);
				$diffMin = ($last - $first) / 60;
				$graph_data = array();
				$graph_label = array();
				$this->percent_total = 0;
				//$this->last_ploted = 0;
				$this->last_time = $first;
				foreach ($related_beans as $event) {
					$event_date =(is_string($event->event_date) ? strtotime($event->event_date) : $event->event_date);
					$calculate_minutes =  ($event_date - $this->last_time ) / 60 ;
					$percent = ( $calculate_minutes / $diffMin ) * 100 ;
					$this->percent_total += $percent ;
					$percent =  $percent > 0 ? $percent : 1 ;
					$graph_data[] =  array($event->name,$percent);
					
					$start_data = explode(' ',$event->event_date);
					$graph_label[] =  $event->name . " at " . $start_data[1];
					$this->graph_colors[$this->graph_index] = $this->getRandomColor();
					$file_name = 'document_templates/'.$event->id.'.png';
					$this->draw_graph_pie_chart($graph_data, $file_name);
					$currentSlide = $this->createTemplatedSlide($objPHPPresentation,$file_name);
					$this->graph_index++;
					
					$this->last_time = $event_date;
				}
				//die;
			}
			$objPHPPresentation->removeSlideByIndex(0);
			return $this->generatePresentation($objPHPPresentation,$bean, 'Pie Chart');
		}
	}
	function generatePresentation(&$objPHPPresentation,&$bean, $chart_type) {
		global $sugar_config, $current_user;
		$upload_path = $this->includeTrailingCharacter ($sugar_config['upload_dir'], '/').$bean->id.".pptx";
		
		$objPHPPresentation->getDocumentProperties()->setCreator($current_user->name)->setLastModifiedBy($current_user->name);
		ob_clean();
		$this->write($objPHPPresentation, $bean->id);
		$file_name = $bean->name.' - '.$chart_type.".pptx";
		if($this->Download){
			$this->download($upload_path, $file_name);
			die;
		}else{
			return array('file_name' => $file_name,'file_address' => $upload_path);
		}
	}
	function includeTrailingCharacter($string, $character) {
		if (strlen($string) > 0) {
			if (substr($string, -1) !== $character) {
				return $string . $character;
			} else {
				return $string;
			}
		} else {
			return $character;
		}
	} 
	function download($pathToFile, $fileName) { 
		header('Content-description: File Download'); 
		header('Content-type: application/force-download'); 
		header('Content-transfer-encoding: binary'); 
		header('Content-length: '.filesize($pathToFile)); 
		header('Content-disposition: attachment; filename="'.$fileName.'"'); 
		readfile($pathToFile); 
	} 
	function getRandomColor(){
		
		$hex = '#';

		//Create a loop.
		foreach(array('r', 'g', 'b') as $color){
			//Random number between 0 and 255.
			$val = mt_rand(0, 255);
			//Convert the random number into a Hex value.
			$dechex = dechex($val);
			//Pad with a 0 if length is less than 2.
			if(strlen($dechex) < 2){
				$dechex = "0" . $dechex;
			}
			//Concatenate
			$hex .= $dechex;
		}

		//Print out our random hex color.
		return $hex;
	}
	function createTemplatedSlide(PhpOffice\PhpPresentation\PhpPresentation $objPHPPresentation, $file_name)
	{
		// Create slide
		$slide = $objPHPPresentation->createSlide();
		
		// Add logo
		$shape = $slide->createDrawingShape();
		$shape->setName('PHPPresentation logo')
			->setDescription('PHPPresentation logo')
			->setPath($file_name);
		
		// Return slide
		return $slide;
	}
	/*
	   Fill a color map with a gradient step between two colors.
	  Arguments:
		$color_a : Starting color for the gradient. Array of (r, g, b)
		$color_b : Ending color for the gradient. Array of (r, g, b)
		$n_steps : Total number of color steps, including color_a and color_b.

	  Returns: A color map array with n_steps colors in the form
			   $colors[i][3], suitable for SetDataColors().

	  Notes:
		You may use the PHPlot internal function $plot->SetRGBColor($color)
		to convert a color name or #rrggbb notation into the required array
		of 3 values (r, g, b) for color_a and color_b.

		Newer versions of PHPlot use 4 components (r, g, b, a) arrays for color.
		This script ignores the alpha component in those arrays.

	*/
	function color_range($color_a, $color_b, $n_steps)
	{
		if ($n_steps < 2) $n_steps = 2;
		$nc = $n_steps - 1;
		# Note: $delta[] and $current[] are kept as floats. $colors is integers.
		for ($i = 0; $i < 3; $i++)
			$delta[$i] = ($color_b[$i] - $color_a[$i]) / $nc;
		$current = $color_a;
		for ($col = 0; $col < $nc; $col++) {
			for ($i = 0; $i < 3; $i++) {
				$colors[$col][$i] = (int)$current[$i];
				$current[$i] += $delta[$i];
			}
		}
		$colors[$nc] = $color_b;  # Make sure the last color is exact.
		return $colors;
	}


	/*
		Determine the number of data sets (plot lines, bars per group, pie
		segments, etc.) contained in a data array.
		This can be used to determine n_steps for $color_range.

	  Arguments:
		$data : PHPlot data array
		$data_type : PHPlot data type, describing $data. (e.g. 'data-data')
	  Returns: The number of data sets in the data array.
	  Notes:
		This has to scan the entire data array. Don't use this unless you
		really don't have a better way to determine the number of data sets.

		This does NOT require that the data array be integer indexed.

	*/
	function count_data_sets($data, $data_type)
	{

		if ($data_type == 'text-data-single')
			return count($data); # Pie chart, 1 segment per record

		# Get the longest data record:
		$max_row = 0;
		foreach ($data as $row)
			if (($n = count($row)) > $max_row) $max_row = $n;

	   if ($data_type == 'text-data' || $data_type == 'text-data-yx')
		  return ($max_row - 1);  # Each record is (label Y1 Y2...)

	   if ($data_type == 'data-data' || $data_type == 'data-data-yx')
		  return ($max_row - 2); # Each record is (label X Y1 Y2...)

	   if ($data_type == 'data-data-error')
		  return (($max_row - 2) / 3); # Each record is (label X Y1 Y1+ Y1-...)

	   # Not a recognized data type... Just return something sane.
	   return $max_row;
	}
	/**
	 * Write documents
	 *
	 * @param \PhpOffice\PhpPresentation\PhpPresentation $phpPresentation
	 * @param string $filename
	 * @param array $writers
	 * @return string
	 */
	function write($phpPresentation, $filename)
	{	global $sugar_config;
		$result = '';
		// Write documents
		foreach ($this->writers as $writer => $extension) {
			$result .= date('H:i:s') . " Write to {$writer} format";
			if (!is_null($extension)) {
				$xmlWriter = IOFactory::createWriter($phpPresentation, $writer);
				$xmlWriter->save("{$filename}.{$extension}");
				$ppt_path = $this->includeTrailingCharacter ($sugar_config['upload_dir'], '/')."{$filename}.{$extension}";
				rename("{$filename}.{$extension}", $ppt_path);
			} else {
				$result .= ' ... NOT DONE!';
			}
		}
		return $result;
	}

}

?>