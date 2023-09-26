<?php
require_once 'custom/include/phplot/phplot.php';
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
	private $graph_colors;
	private $graph_index;
	
	public function __construct($module,$ids){
		$this->pie_slices = 20;
		$this->base_angle = 90;
		$this->module = $module;
		$this->selected_ids = $ids;
		$this->graph_colors = array();
		$this->graph_index = 0;
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

	function draw_graph($data,$file_name){
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
		$plot->SetIsInline(true);
		$this->draw_plot($plot, 'CW',  100, 100);
	}

	//////////////////////////////////////////////////////////////////////////////
	function generatePresentation(){
		global $sugar_config, $graph_label, $timedate;
		$writers = array('PowerPoint2007' => 'pptx');
				
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
					//print"<pre> percent before";print_r($percent);
					//$percent -= $this->percent_total ;
					//print"<pre>  percent after";print_r($percent);
					//print"<pre>";print_r($this);
					$this->percent_total += $percent ;
					$percent =  $percent > 0 ? $percent : 1 ;
					$graph_data[] =  array($event->name,$percent);
					
					$start_data = explode(' ',$event->event_date);
					$graph_label[] =  $event->name . " at " . $start_data[1];
					$this->graph_colors[$this->graph_index] = $this->getRandomColor();
					$file_name = 'document_templates/'.$event->id.'.png';
					$this->draw_graph($graph_data, $file_name);
					print"<pre>";print_r($graph_data);
					$currentSlide = $this->createTemplatedSlide($objPHPPresentation,$file_name);
					$this->graph_index++;
					
					$this->last_time = $event_date;
				}
				//die;
			}
			$objPHPPresentation->removeSlideByIndex(0);
			$this->write($objPHPPresentation, $bean->name, $writers);
			ob_clean();
			$this->download("{$bean->name}.pptx");
			die;
		}
	}


	function download($pathToFile) { 
		header('Content-description: File Download'); 
		header('Content-type: application/force-download'); 
		header('Content-transfer-encoding: binary'); 
		header('Content-length: '.filesize($pathToFile)); 
		header('Content-disposition: attachment; filename="'.basename($pathToFile).'"'); 
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

	/**
	 * Write documents
	 *
	 * @param \PhpOffice\PhpPresentation\PhpPresentation $phpPresentation
	 * @param string $filename
	 * @param array $writers
	 * @return string
	 */
	function write($phpPresentation, $filename, $writers)
	{
		$result = '';
		// Write documents
		foreach ($writers as $writer => $extension) {
			$result .= date('H:i:s') . " Write to {$writer} format";
			if (!is_null($extension)) {
				$xmlWriter = IOFactory::createWriter($phpPresentation, $writer);
				$xmlWriter->save("{$filename}.{$extension}");
		   
			   // rename("{$filename}.{$extension}", "/results/{$filename}.{$extension}");
			} else {
				$result .= ' ... NOT DONE!';
			}
		}
		return $result;
	}

}

?>