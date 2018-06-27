<?php
class ExportsController extends AppController {
    var $name = 'Exports';
    // load the PhpExcel component - case is important
    public $components = array('PhpExcel.PhpExcel');

    function excel($table=array(),$data=array()) {
        $this->PhpExcel->createWorksheet()->setDefaultFont('Calibri', 12);
        
        /*
        // define table cells
        $table = array(
            array('label' => __('User'), 'filter' => true),
            array('label' => __('Type'), 'filter' => true),
            array('label' => __('Date')),
            array('label' => __('Description'), 'width' => 50, 'wrap' => true),
            array('label' => __('Modified'))
        );
        */
        
        // add heading with different font and bold text
        $this->PhpExcel->addTableHeader($table, array('name' => 'Title', 'bold' => true));
        
        // add data
        if(!empty($data)){
            foreach ($data as $d) {
                $this->PhpExcel->addTableRow($d);
            }
        }
        
        // close table and output
        $this->PhpExcel->addTableFooter()->output();
    }

}
?>