<?php
/* @var $this DefaultController */
$this->menu=array(
        array('label'=>'BLAST index', 'url'=>array('index')),
        //array('label'=>'Check Jobs', 'url'=>array('index'))
        array('label'=>'Modify configuration', 'url'=>array('BLASTGene/configuration')),
        array('label'=>'View stored configuration', 'url'=>array('BLASTGene/viewConfiguration')),
    );

$this->breadcrumbs=array(
        $this->module->id => array('index'),
	'Search'
);
?>
<h1>BLASTSearch</h1>
<div class="form">
<?php
        $form = $this->beginWidget(
            'CActiveForm',
            array(
                'id' => 'blast-search-form',
                'enableClientValidation' => true,
                'enableAjaxValidation' => false,
                'clientOptions' => array(
                    'validateOnSubmit' => true),
                'htmlOptions' => array('enctype' => 'multipart/form-data'),
            )
        );
    ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
        
	<?php echo $form->errorSummary($model); ?>
        
        <div class="row">
		<?php echo $form->labelEx($model,'Email'); ?>
		<?php echo $form->textField($model,'Email',array('size'=>50,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'Email'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'JobTitle'); ?>
		<?php echo $form->textField($model,'JobTitle',array('size'=>50,'maxlength'=>500,'value'=>'Job 1')); ?>
		<?php echo $form->error($model,'JobTitle'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SequenceType'); ?>
                <?php echo $form->ListBox($model,'SequenceType', 
                    array('dna' => 'dna','protein' => 'protein')); ?>
		<?php /*echo $form->textField($model,'SequenceType',array('size'=>50,'maxlength'=>500));*/ ?>
		<?php echo $form->error($model,'SequenceType'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Sequence'); ?>
		<?php echo $form->textArea($model,'Sequence',array('size'=>60,'maxlength'=>5000)); ?>
		<?php echo $form->error($model,'Sequence'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'Program'); ?>
                <?php echo $form->ListBox($model,'Program', 
                     array('blastx'=>'blastx','blastn' => 'blastn', 'tblastn' => 'tblastn')); ?>
		<?php /*echo $form->textField($model,'Program',array('size'=>60,'maxlength'=>5000));*/ ?>
		<?php echo $form->error($model,'Program'); ?>
	</div>
        <!-- Bases de datos, todas las del EBI -->
        <div class="row">
		<?php echo $form->labelEx($model,'Database'); ?>
                <?php echo $form->ListBox($model,'Database', 
                    array('em_rel_pln' => 'em_rel_pln', 
                          'uniprotkb'=>'UniProt Knowledgebase',
                                        /* PROTEIN */
                            'uniprotkb' => 'UniProt Knowledgebase',
                            'uniprotkb_swissprot' => 'UniProtKB/Swiss-Prot',
                            'uniprotkb_swissprotsv' => 'UniProtKB/Swiss-Prot isoforms ',
                            'uniprotkb_trembl' => 'UniProtKB/TrEMBL',

                                    /*UniProtKB Taxonomic Subsets*/

                            'uniprotkb_archaea' => 'UniProtKB Archaea',
                            'uniprotkb_arthropoda' => 'UniProtKB Arthropoda',
                            'uniprotkb_bacteria' => 'UniProtKB Bacteria',
                            'uniprotkb_complete_microbial_proteomes' => 'UniProtKB Complete Microbial Proteomes',
                            'uniprotkb_eukaryota' => 'UniProtKB Eukaryota',
                            'uniprotkb_fungi' => 'UniProtKB Fungi',
                            'uniprotkb_human' => 'UniProtKB Human',
                            'uniprotkb_mammals' => 'UniProtKB Mammals',
                            'uniprotkb_nematoda' => 'UniProtKB Nematoda',
                            'uniprotkb_pdb' => 'UniProtKB PDB',
                            'uniprotkb_rodents' => 'UniProtKB Rodents',
                            'uniprotkb_vertebrates' => 'UniProtKB Vertebrates',
                            'uniprotkb_viruses' => 'UniProtKB Viruses',
          
                                        /* UniProt Clusters */
                             'uniref100' => 'UniProt Clusters 100%',
                             'uniref100_seg' => 'UniProt Clusters 100% (SEG filtered)',
                             'uniref90' => 'UniProt Clusters 90%',
                             'uniref50' => 'UniProt Clusters 50%',

                                            /* Patents */
                             'epop' => 'EPO Patent Protein Sequences',
                             'jpop' => 'JPO Patent Protein Sequences',
                             'kpop' => 'KIPO Patent Protein Sequences',
                             'uspop' => 'USPTO Patent Protein Sequences',
                             'nrpl1' => 'NR Patent Proteins Level-1',
                             'nrpl2' => 'NR Patent Proteins Level-2',

                                           /* Structure  */
                             'pdb' => 'Protein Structure Sequences',
                             'sgt' => 'Structural Genomics Targets',

                                       /* Other Protein Databases */
                             'uniparc' => 'UniProt Archive',
                             'intact' => 'IntAct',
                             'imgthlap' => 'IMGT/HLA',
                             'ipdkirp' => 'IPD-KIR',
                             'ipdmhcp' => 'IPD-MHC',

                            /* NUCLEOTIDE DATABASES */ 

                            /*  ENA Sequence (formerly EMBL-Bank) */ 
                             'em_rel_est_env' => 'ENA Sequence EST Environmental',
                             'em_rel_gss_env' => 'ENA Sequence GSS Environmental', 
                             'em_rel_htc_env' => 'ENA Sequence HTC Environmental', 
                             'em_rel_htg_env' => 'ENA Sequence HTG Environmental', 
                             'em_rel_pat_env' => 'ENA Sequence Patent Environmental', 
                             'em_rel_std_env' => 'ENA Sequence Standard Environmental', 
                             'em_rel_sts_env' => 'ENA Sequence STS Environmental',
                             'em_rel_tsa_env' => 'ENA Sequence TSA Environmental', 


                             'em_rel_fun' => 'ENA Sequence Fungi', 
                             'em_rel_est_fun' => 'ENA Sequence EST Fungi', 
                             'em_rel_gss_fun' => 'ENA Sequence GSS Fungi', 
                             'em_rel_htc_fun' => 'ENA Sequence HTC Fungi', 
                             'em_rel_htg_fun' => 'ENA Sequence HTG Fungi', 
                             'em_rel_pat_fun' => 'ENA Sequence Patent Fungi', 
                             'em_rel_std_fun' => 'ENA Sequence Standard Fungi', 
                             'em_rel_sts_fun' => 'ENA Sequence STS Fungi', 
                             'em_rel_tsa_fun' => 'ENA Sequence TSA Fungi',


                             'em_rel_hum' => 'ENA Sequence Human', 
                             'em_rel_est_hum' => 'ENA Sequence EST Human', 
                             'em_rel_gss_hum' => 'ENA Sequence GSS Human', 
                             'em_rel_htc_hum' => 'ENA Sequence HTC Human', 
                             'em_rel_htg_hum' => 'ENA Sequence HTG Human', 
                             'em_rel_pat_hum' => 'ENA Sequence Patent Human', 
                             'em_rel_std_hum' => 'ENA Sequence Standard Human', 
                             'em_rel_sts_hum' => 'ENA Sequence STS Human', 


                             'em_rel_inv' => 'ENA Sequence Invertebrate',
                             'em_rel_est_inv' => 'ENA Sequence EST Invertebrate', 
                             'em_rel_gss_inv' => 'ENA Sequence GSS Invertebrate', 
                             'em_rel_htc_inv' => 'ENA Sequence HTC Invertebrate', 
                             'em_rel_htg_inv' => 'ENA Sequence HTG Invertebrate', 
                             'em_rel_pat_inv' => 'ENA Sequence Patent Invertebrate', 
                             'em_rel_std_inv' => 'ENA Sequence Standard Invertebrate', 
                             'em_rel_sts_inv' => 'ENA Sequence STS Invertebrate', 
                             'em_rel_tsa_inv' => 'ENA Sequence TSA Invertebrate', 

                             'em_rel_mam' => 'ENA Sequence Mammal', 
                             'em_rel_est_mam' => 'ENA Sequence EST Mammal', 
                             'em_rel_gss_mam' => 'ENA Sequence GSS Mammal', 
                             'em_rel_htc_mam' => 'ENA Sequence HTC Mammal', 
                             'em_rel_htg_mam' => 'ENA Sequence HTG Mammal', 
                             'em_rel_pat_mam' => 'ENA Sequence Patent Mammal', 
                             'em_rel_std_mam' => 'ENA Sequence Standard Mammal', 
                             'em_rel_sts_mam' => 'ENA Sequence STS Mammal', 
                             'em_rel_tsa_mam' => 'ENA Sequence TSA Mammal', 

                             'em_rel_mus' => 'ENA Sequence Mouse', 
                             'em_rel_est_mus' => 'ENA Sequence EST Mouse', 
                             'em_rel_gss_mus' => 'ENA Sequence GSS Mouse', 
                             'em_rel_htc_mus' => 'ENA Sequence HTC Mouse', 
                             'em_rel_htg_mus' => 'ENA Sequence HTG Mouse', 
                             'em_rel_pat_mus' => 'ENA Sequence Patent Mouse', 
                             'em_rel_std_mus' => 'ENA Sequence Standard Mouse', 
                             'em_rel_sts_mus' => 'ENA Sequence STS Mouse', 

                             'em_rel_phg' => 'ENA Sequence Phage', 
                             'em_rel_gss_phg' => 'ENA Sequence GSS Phage', 
                             'em_rel_htg_phg' => 'ENA Sequence HTG Phage', 
                             'em_rel_pat_phg' => 'ENA Sequence Patent Phage',
                             'em_rel_std_phg' => 'ENA Sequence Standard Phage', 


                             'em_rel_pln' => 'ENA Sequence Plant', 
                             'em_rel_est_pln' => 'ENA Sequence EST Plant', 
                             'em_rel_gss_pln' => 'ENA Sequence GSS Plant', 
                             'em_rel_htc_pln' => 'ENA Sequence HTC Plant', 
                             'em_rel_htg_pln' => 'ENA Sequence HTG Plant', 
                             'em_rel_pat_pln' => 'ENA Sequence Patent Plant', 
                             'em_rel_std_pln' => 'ENA Sequence Standard Plant', 
                             'em_rel_sts_pln' => 'ENA Sequence STS Plant', 
                             'em_rel_tsa_pln' => 'ENA Sequence TSA Plant', 

                             'em_rel_pro' => 'ENA Sequence Prokaryote', 
                             'em_rel_est_pro' => 'ENA Sequence EST Prokaryote',
                             'em_rel_gss_pro' => 'ENA Sequence GSS Prokaryote', 
                             'em_rel_htc_pro' => 'ENA Sequence HTC Prokaryote', 
                             'em_rel_htg_pro' => 'ENA Sequence HTG Prokaryote', 
                             'em_rel_pat_pro' => 'ENA Sequence Patent Prokaryote', 
                             'em_rel_std_pro' => 'ENA Sequence Standard Prokaryote', 
                             'em_rel_sts_pro' => 'ENA Sequence STS Prokaryote', 
                             'em_rel_tsa_pro' => 'ENA Sequence TSA Prokaryote', 

                             'em_rel_rod' => 'ENA Sequence Rodent', 
                             'em_rel_est_rod' => 'ENA Sequence EST Rodent', 
                             'em_rel_gss_rod' => 'ENA Sequence GSS Rodent', 
                             'em_rel_htc_rod' => 'ENA Sequence HTC Rodent', 
                             'em_rel_htg_rod' => 'ENA Sequence HTG Rodent', 
                             'em_rel_pat_rod' => 'ENA Sequence Patent Rodent', 
                             'em_rel_std_rod' => 'ENA Sequence Standard Rodent', 
                             'em_rel_sts_rod' => 'ENA Sequence STS Rodent', 
                             'em_rel_tsa_rod' => 'ENA Sequence TSA Rodent', 

                             'em_rel_syn' => 'ENA Sequence Synthetic', 
                             'em_rel_pat_syn' => 'ENA Sequence Patent Synthetic', 
                             'em_rel_std_syn' => 'ENA Sequence Standard Synthetic', 

                             'em_rel_tgn' => 'ENA Sequence Transgenic', 
                             'em_rel_std_tgn' => 'ENA Sequence Standard Transgenic',
                             'em_rel_gss_tgn' => 'ENA Sequence GSS Transgenic', 

                             'em_rel_unc' => 'ENA Sequence Unified', 
                             'em_rel_est_unc' => 'ENA Sequence EST Unified',
                             'em_rel_pat_unc' => 'ENA Sequence Patent Unified', 
                             'em_rel_std_unc' => 'ENA Sequence Standard Unified', 

                             'em_rel_vrl' => 'ENA Sequence Viral', 
                             'em_rel_est_vrl' => 'ENA Sequence EST Viral',
                             'em_rel_gss_vrl' => 'ENA Sequence GSS Viral', 
                             'em_rel_htg_vrl' => 'ENA Sequence HTG Viral', 
                             'em_rel_pat_vrl' => 'ENA Sequence Patent Viral', 
                             'em_rel_std_vrl' => 'ENA Sequence Standard Viral', 
                             'em_rel_tsa_vrl' => 'ENA Sequence TSA Viral', 

                             'em_rel_vrt' => 'ENA Sequence Vertebrate', 
                             'em_rel_est_vrt' => 'ENA Sequence EST Vertebrate',
                             'em_rel_gss_vrt' => 'ENA Sequence GSS Vertebrate', 
                             'em_rel_htc_vrt' => 'ENA Sequence HTC Vertebrate', 
                             'em_rel_htg_vrt' => 'ENA Sequence HTG Vertebrate', 
                             'em_rel_pat_vrt' => 'ENA Sequence Patent Vertebrate', 
                             'em_rel_std_vrt' => 'ENA Sequence Standard Vertebrate', 
                             'em_rel_sts_vrt' => 'ENA Sequence STS Vertebrate', 
                             'em_rel_tsa_vrt' => 'ENA Sequence TSA Vertebrate', 


                             'emnew' => 'ENA Sequence Updates', 
                             'em_cds_rel' => 'ENA Coding Sequence Release',
                             'em_cds_cum' => 'ENA Coding Sequence Updates', 
                             'em_ncr_rel' => 'ENA Non-Coding Sequence Release', 
                             'em_ncr_cum' => 'ENA Non-Coding Sequence Updates', 
                             'em_geo_rel' => 'ENA Geospatial Release', 
                             'em_geo_cum' => 'ENA Geospatial Updates', 

                            /* Others */

                             'em_rel_est' => 'ENA Sequence Expressed Sequence Tag', 
                             'em_rel_gss' => 'ENA Sequence Genome Survey Sequence', 
                             'em_rel_htc' => 'ENA Sequence High Throughput cDNA', 
                             'em_rel_htg' => 'ENA Sequence High Throughput Genome', 
                             'em_rel_pat' => 'ENA Sequence Patent', 
                             'em_rel_std' => 'ENA Sequence Standard', 
                             'em_rel_sts' => 'ENA Sequence Sequence Tagged Site', 
                             'em_rel_tsa' => 'ENA Sequence Transcriptome Shotgun Assembly', 
                             'emall' => 'ENA Sequence Release and Updates', 
                             'emvec' => 'ENA Sequence Vectors', 



                            /* IMGT */

                             'imgtgm' => 'IMGTGM-DB', 
                             'imgthla' => 'IMGTHLA', 
                             'ipdkir' => 'IPD-KIR', 
                             'ipdmhc' => 'IPD-MHC', 


                            /* Patents */

                             'nrnl1' => 'NR Patent DNAs Level-1',
                             'nrnl2' => 'NR Patent DNAs Level-2', 

                            /* Structure */ 

                             'pdbna' => 'Nucleotide Structure Sequences',
                        
                        
                        )); ?>
		<?php /*echo $form->textField($model,'Database',array('size'=>60,'maxlength'=>5000)); */?>
		<?php echo $form->error($model,'Database'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'Matriz'); ?>
                <?php echo $form->ListBox($model,'Matriz', 
                    array('BLOSUM62' => 'BLOSUM62','BLOSUM45'=>'BLOSUM45','BLOSUM50'=>'BLOSUM50',
                          'BLOSUM80' => 'BLOSUM80','BLOSUM90'=>'BLOSUM90',
                          'PAM30' => 'PAM30','PAM70'=>'PAM70',
                          'PAM250' => 'PAM250'), array('selected'=>'BLOSUM62')); ?>
		<?php /*echo $form->textField($model,'Database',array('size'=>60,'maxlength'=>5000)); */?>
		<?php echo $form->error($model,'Matriz'); ?>
	</div>
    
        <div class="row">
		<?php echo $form->labelEx($model,'Scores'); ?>
		<?php echo $form->textField($model,'Scores',array('size'=>60,'maxlength'=>5000, 'value'=>'50')); ?>
		<?php echo $form->error($model,'Scores'); ?>
	</div>
    
        <div class="row">
		<?php echo $form->labelEx($model,'Alignments'); ?>
		<?php echo $form->textField($model,'Alignments',array('size'=>60,'maxlength'=>5000, 'value'=>'50')); ?>
		<?php echo $form->error($model,'Alignments'); ?>
	</div>
    
        <div class="row">
		<?php echo $form->labelEx($model,'ExpectValThreshold'); ?>
		<?php echo $form->textField($model,'ExpectValThreshold',array('size'=>60,'maxlength'=>5000, 'value' => '10')); ?>
		<?php echo $form->error($model,'ExpectValThreshold'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'Organism'); ?>
		<?php echo $form->textField($model,'Organism',array('size'=>60,'maxlength'=>5000)); ?>
		<?php echo $form->error($model,'Organism'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'GapOpen'); ?>
		<?php echo $form->textField($model,'GapOpen',array('size'=>60,'maxlength'=>5000, 'value'=>'5')); ?>
		<?php echo $form->error($model,'GapOpen'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'GapExtend'); ?>
		<?php echo $form->textField($model,'GapExtend',array('size'=>60,'maxlength'=>5000, 'value'=>'2')); ?>
		<?php echo $form->error($model,'GapExtend'); ?>
	</div>
            
        <div class="row">
		<?php echo $form->labelEx($model,'Filter'); ?>
                <?php echo $form->ListBox($model,'Filter', 
                    array('F' => 'No','T'=>'Yes')); ?>
		<?php /*echo $form->textField($model,'Database',array('size'=>60,'maxlength'=>5000)); */?>
		<?php echo $form->error($model,'Filter'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'Dropoff'); ?>
                <?php echo $form->ListBox($model,'Dropoff', 
                    array('0' => '0','2'=>'2','4'=>'4','8'=>'8','10'=>'10')); ?>
		<?php /*echo $form->textField($model,'Database',array('size'=>60,'maxlength'=>5000)); */?>
		<?php echo $form->error($model,'Dropoff'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'Seqrange'); ?>
		<?php echo $form->textField($model,'Seqrange',array('size'=>60,'maxlength'=>5000, 'value'=>'START-END')); ?>
		<?php echo $form->error($model,'Seqrange'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'Gapalign'); ?>
                <?php echo $form->ListBox($model,'Gapalign', 
                    array('true' => 'true','false'=>'false')); ?>
		<?php /*echo $form->textField($model,'Database',array('size'=>60,'maxlength'=>5000)); */?>
		<?php echo $form->error($model,'Gapalign'); ?>
	</div>
   
        <div class="row">
		<?php echo $form->labelEx($model,'Compstats'); ?>
                <?php echo $form->ListBox($model,'Compstats', 
                    array('F' => 'F','D'=>'D','1'=>'1','2'=>'2','3'=>'3')); ?>
		<?php /*echo $form->textField($model,'Database',array('size'=>60,'maxlength'=>5000)); */?>
		<?php echo $form->error($model,'Compstats'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('BLAST'); ?>
	</div>

<?php $this->endWidget(); ?>
</div>