<?php

class DefaultController extends Controller {

    public $layout = '//layouts/column2';
    
    // <editor-fold defaultstate="collapsed" desc="Framework related functions: accessRules, etc">
        /**
         * @return array action filters
         */
        public function filters()
        {
                return array(
                        'accessControl', // perform access control for CRUD operations
                );
        }
        /**
         * Specifies the access control rules.
         * This method is used by the 'accessControl' filter.
         * @return array access control rules
         */
        public function accessRules()
        {
                return array(
                        array('allow', // allow admin user to perform 'admin' and 'delete' actions
                                'actions'=>array('index','BLASTSearch','ViewGeneDetails','ViewJob','AutomaticBLAST'),
                                'users'=>array('@'),
                        ),
                        array('deny',  // deny all users
                                'users'=>array('*'),
                        ),
                );
        }
    // </editor-fold>




    public function actionIndex() {
        $this->render('index');
    }

    /**
     * Render the form used to request a BLAST search, using the fields 
     * in the model BlastGene
     */
    public function actionBLASTSearch() {
        $model = new BLASTGene();
        $model->setscenario('blastsearch');
        
        
        if (isset($_POST['BLASTGene'])) {
            $model->attributes = $_POST['BLASTGene'];
            
            
            if ($model->validate()) {
                $blast_job_result = $model->requestBLASTSearch($model);
                $organism = $model->Organism;
               $this->redirect($this->createUrl('ViewJob', array('pJobId' => $blast_job_result, 
                                                                 'organismo' => $organism )));
            }
        }
        $this->render('blastsearch', array('model' => $model));
    }
    
    
    public function actionAutomaticBLAST(){
        //$this->redirect($this->createUrl('processing'));
        //this section should be loaded automatically from the DB, using the user name
        $bgene = new BLASTGene();
        $bgene->Email = 'correo@mail.com';
        $bgene->Program ='blastn';
        $bgene->Database = 'em_rel_pln';
//        $bgene->Sequence = "AATCGATCGATGCTAGCTAGCTGACCACACACTGTTGCTGATCGATCGTAGCTAGCTGTGTGTACTACACCACACTGACTATCG";
        $bgene->SequenceType = 'dna';
        Yii::app()->getSession()->add('BLAST_Configuration', $bgene);
        //end
        
        
        if(isset($_POST['Sequence'])){
            $BLASTGene = Yii::app()->getSession()->get('BLAST_Configuration');
            $BLASTGene->Sequence = $_POST['Sequence'];
            $blast_job_result = $BLASTGene->requestBLASTSearch($BLASTGene);
            $this->redirect($this->createUrl('ViewJob', array('pJobId' => $blast_job_result)));
        }
    }
    

    public function actionViewJob($pJobId, $organismo) {
        /*
         * Muestra el job en la web page 
         * 
         */
        $model = new BLASTGene();

        $job_status = $model->getJobStatus($pJobId);
     
        echo $organismo;

        if ($job_status === BLASTGene::$JOB_STATUS_FINISHED) {
            //$job_image_result = $model->getPNGJobResult($pJobId);
            $job_xml_result = $model->getXMLJobResult($pJobId);
            $BLASTResult_items = BLASTResultItem::getInstance()->getBLASTResultItemFromXMLRawResult($job_xml_result, $organismo);
            
            $blast_data_provider = new CArrayDataProvider($BLASTResult_items, array(
                'id' => 'blast-search-result',
                'keyField' => 'ID',
                'pagination' => array(
                    'pageSize' => 500,
                ),
                'sort'=>array(
                    'attributes'=> BLASTResultItem::getInstance()->getAttributes()),
            ));
            
   // ***********************************
   // descarga del archivo
            // output headers so that the file is downloaded rather than displayed
   /* header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=blastfile.csv');*/

     //create a file pointer connected to the output stream
       /* flush();
        $output = fopen('php://output', 'wb');
        ob_clean();*/
    

    // output the column headings
       /* fputcsv($output, array('Database', 'ID', 'AC', 'Length','Score', 'Expectation', 'Identity', 'Gaps', 'Bits', 'Description'));
        $i=0;
        
        while ($i < sizeof($BLASTResult_items)){
            $file = array();
        
            $database = $BLASTResult_items[$i]['Database'];
            $id = $BLASTResult_items[$i]['ID'];
            $ac = $BLASTResult_items[$i]['AC'];
            $length = $BLASTResult_items[$i]['Length'];
            $score = $BLASTResult_items[$i]['Score'];
            $expectation = $BLASTResult_items[$i]['Expectation'];
            $identity = $BLASTResult_items[$i]['Identity'];
            $gaps = $BLASTResult_items[$i]['Gaps'];
            $bits = $BLASTResult_items[$i]['Bits'];
            $description = $BLASTResult_items[$i]['Description'];
            array_push($file, $database, $id, $ac, $length, $score, $expectation, $identity, $gaps, $bits, $description);
            $i=$i+1;
            fputcsv($output, $file);
        }
        fclose($output);
        flush() ;*/

     //var_dump($BLASTResult_items);
            // ****************
            // fin descarga de archivo
    
        }else{
            $blast_data_provider = null;
            $BLASTResult_items = null;
        }
        
        // esto es lo que imprime la basura en el archivo
        
        $this->render('viewjob', array(
            'model' => $model,
            'job_status' => $job_status,
            'job_id' => $pJobId,
            'result_columns' => BLASTResultItem::getInstance()->getAttributes(),
            'blast_result_items' => $BLASTResult_items,
            //'job_image_result' => $job_image_result,
            'blast_data_provider' => $blast_data_provider,
        ));
    }
    
    
    public function actionViewGeneDetails($pGeneAccessCode){
        $gene_details = EBIGeneDetails::getInstance()->getEBIGeneDetails($pGeneAccessCode);
        //$gene_details = EBIGeneDetails::getInstance()->getEBIGeneDetailsFromSimpleXMLElement($raw_gene_details);
        
        
        $this->render('genedetails', array(
                'gene_details' => $gene_details,
                'access_code' => $pGeneAccessCode,
                ));
    }

    /**
     * Performs the AJAX validation.
     * @param Gen $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'gen-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
