<?php 
/* This class simply generates FACILITY CONSUMPTION DATA REPORT & REQUEST for each facility, places the content in a pdf and sends
them via mail to HCMP, DHCP */
class fcdrr_auto_email extends MY_Controller{

	function __construct()
	{
		parent::__construct();

		$this->load->config->item('email');
		$this->load->library('email');

		$this->load->model('fcdrr_model');
	}

	function index(){

		$this->load->library('mpdf/mpdf');// Load the mpdf library

		//calculate previous dates
		if(date('m')==1)
		{
			$previous_month=12;
			$year=date('Y')-1;
		}
		else
		{
			$previous_month=date('m')-1;
			$year=date('Y');
		}

		$fromdate=$year.'-'.$previous_month.'-01';
		$num_of_days=cal_days_in_month(CAL_GREGORIAN, $previous_month,$year);
		$todate=$year.'-'.$previous_month.'-'.$num_of_days;

		$CHAI_team=array('mwangikevinn@gmail.com','brianhawi92@gmail.com');

		//table styling
		$css_styling = '<style>table.data-table {border: 1px solid #DDD;margin: 10px auto;border-spacing: 0px;}
						table.data-table th {border: none;color: #036;text-align: center;background-color: #F5F5F5;border: 1px solid #DDD;border-top: none;max-width: 450px;}
						table.data-table td, table th {padding: 4px;}
						table.data-table td {border: none;border-left: 1px solid #DDD;border-right: 1px solid #DDD;height: 30px;margin: 0px;border-bottom: 1px solid #DDD;}
						.col5{background:#D8D8D8;}</style>';

		$header='<h2>FACILITY CONSUMPTION DATA REPORT & REQUEST(F-CDRR) FOR ART LABORATORY MONITORING REAGENTS</h2>';

		$fromdate='2015-02-01';
		$todate='2015-02-28';

		$fcdrr_list="";

		$fcdrr_list=$this->fcdrr_model->get_fcdrr_list($fromdate,$todate);

			foreach($fcdrr_list->result_array() as $fcdrr_result)
			{	
				$final_pdf_data=$this->fcdrr_model->get_fcdrr_content($fcdrr_result);

				if($final_pdf_data)
				{
					$pdf_document=$css_styling.$header.$final_pdf_data;

					$mpdf=new mPDF(); 
					$mpdf->AddPage('', 'A4-L', 0, '', 15, 15, 16, 16, 9, 9, ''); 
					$mpdf->SetDisplayMode('fullpage');
					$mpdf->simpleTables = true;

					$mpdf->SetDisplayMode('fullpage');
					$mpdf->simpleTables = true;

					$mpdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
					$mpdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
					//Generate pdf using mpdf
					               
			        $mpdf ->SetWatermarkText("Nascop",-5);
			        $mpdf ->watermark_font = "sans-serif";
			        $mpdf ->showWatermarkText = true;
					$mpdf ->watermark_size="0.5";

					$filename=str_replace('/','-', $fcdrr_result['name']);

					$mpdf->WriteHTML($pdf_document);
					try
					{
						$filename=$this->config->item('server_root').'pdf_documents/fcdrr_individual_monthly/'.$filename.'.pdf';

						$mpdf->Output($filename,'F');
					}
					catch(exception $e)
					{
						$e->getMessage();
					}

					/* Prepare email configurations */

					$month_name=$this->GetMonthName($previous_month);

					$this->email->from('cd4system@gmail.com', 'CD4 Administrator');

					$this->email->subject('CD4 FCDRR Commodity Reports for '.$month_name.' - '.$year.' '); //subject

					$message="Good Day<br />Find attached the FCDRR Report For ART Lab Monitoring Reagents for ".$fcdrr_result['name']." for the month of ".$month_name.", ".$year.".<br />
						Regards.
						<br /><br />CD4 Support Team";

					$this->email->message($message);// the message

					// $county_coordinator_email=$this->fcdrr_model->get_county_email($fcdrr_result['sub_county_id']);

					// foreach($county_coordinator_email as $cemail)
					// {
					// 	$county_receipients[]=$cemail;
					// }
					
					// $partner_email=$this->fcdrr_model->get_partner_email($fcdrr_result['partner_id']);

					// foreach($partner_email as $pemail)
					// {
					// 	$partner_receipients[]=$pemail;
					// }

					// $email_receipients=array_merge($partner_receipients,$county_receipients);

					//$this->email->to($email_receipients); //send to specific receiver
					$this->email->to($CHAI_team); //CHAI team

					$this->email->attach($filename);

					if($this->email->send())//send email and check if the email was sent
					{	
						$this->email->clear(TRUE);//clear any attachments on the email
						echo "FCDRR Email Alert to '".$fcdrr_result["name"]."' has been sent! <br />";
					}
					else 
					{
						show_error($this->email->print_debugger());//show error message
					}
				}

			} // end foreach

		
	} // end function

}