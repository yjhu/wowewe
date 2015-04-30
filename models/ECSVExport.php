<?php
namespace app\models;

use Yii;
use yii\base\InvalidConfigException;
use yii\base\Exception;
use yii\db\Connection;

use Yii\data\ActiveDataProvider;
use Yii\data\SqlDataProvider;
use Yii\data\Command;
use yii\db\ActiveRecord;


/**
 * export a csv file (string) from given SqlDataProvider
 * usage in your controller:
 * Yii::import('ext.CSVExport');
 * $provider = YourClass::model()->createCSqlProvider()
 * or
 * $provider = Yii::app()->db->creatCommand(...)->queryAll();
 * $csv = new ECSVExport($provider);
 * $content = $csv->toCSV();					
 * Yii::app()->getRequest()->sendFile($filename, $content, "text/csv", false);
 * exit();
 * 
 * You can also do this now:
 * $cmd = Yii::app()->db->createCommand("SELECT * FROM track_test LIMIT 10");
 * $csv = new ECSVExport($cmd);        
 * $csv->setOutputFile($outputFile);
 * $csv->toCSV();
 *

Yii::import('ext.ECSVExport');
 
// for use with array of arrays
$data = array(
    array('key1'=>'value1', 'key2'=>'value2')
    ....
)
 
$csv = new ECSVExport($data);
$output = $csv->toCSV(); // returns string by default
 
echo $output;
 
// gives you something like
key1,key2
value1,value2
 
// OR
$csv = new ECSVExport($provider);
$content = $csv->toCSV();                   
Yii::app()->getRequest()->sendFile($filename, $content, "text/csv", false);
exit();

Writing To File

Yii::import('ext.ECSVExport');
 
// for use with array of arrays
$data = array(
    array('key1'=>'value1', 'key2'=>'value2')
    ....
)
 
$filename = 'somewriteablefile.csv';
$csv = new ECSVExport($data);
$csv->toCSV($filename); // returns string by default
 
echo file_get_contents($filename);
 
// gives you something like
key1,key2
value1,value2

Human Readable headers

$headers = array('header_to_change'=>'new value');
$csv->setHeaders($headers);
 
// or
 
$csv->setHeader($currentHeaderValue, $newHeaderValue);

Per Row Callback

// callback must be is_callable by php or exception is thrown
 
$csv->setCallback(function($row){
    $new = array();
    foreach($row as $k=>$v) {
        $new[$k] = $v * $v;
    }
    return $new;
});

Exclude Columns

$exclude = array('getlost','dontshow'...);
$csv->setExclude($exclude);
 
// or
 
$csv->setExclude($nameofcolumn);

Various Provider types

// Command
$cmd = Yii::app()->db->createCommand("SELECT * FROM track_test LIMIT 10");
$csv = new ECSVExport($cmd);        
$csv->setOutputFile($outputFile);
$csv->toCSV();
 
// SqlDataProvider
// Defaults to looping through all pages, use $csv->exportCurrentPageOnly(); to turn that off
$count=Yii::app()->db->createCommand('SELECT COUNT(*) FROM track_test WHERE campaign_id=1')->queryScalar();
$sql='SELECT * FROM track_test WHERE campaign_id=1';
$dataProvider=new SqlDataProvider($sql, array(
    'totalItemCount'=>$count,
    'pagination'=>array(
        'pageSize'=>10,
    ),
));
 
$csv = new ECSVExport($dataProvider);
$csv->exportCurrentPageOnly(); // if not set will loop through all pages!
$csv->setOutputFile($this->outputFile);
$csv->toCSV();
 
// ActiveDataProvider
$dataProvider = new ActiveDataProvider('Track', array(
    'criteria'=>array(
        'condition'=>'campaign_id=1 and type=1'
    )
));
$csv = new ECSVExport($dataProvider);
$csv->setOutputFile($this->outputFile);
$csv->toCSV();
 
// Active Records
$csv = new ECSVExport(Track::model()->findAllByAttributes(array('campaign_id'=>1,'type'=>Track::TYPE_INT_SUCCESS)));
$csv->setOutputFile($this->outputFile);
$csv->toCSV();
 */

/*
	//hehbhehb
	$csv = new ECSVExport($dataProvider);
	$csv->setHeaders(array('pv'=>'浏览量','sum_pv'=>'访客'));
	$csv->setExclude(array('sid','year'));

	//1
	$filename = Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'a.csv';					
	$csv->setOutputFile($filename);	
	$csv->toCSV();
	exit();

	//2
	$content = $csv->toCSV();	
	Yii::app()->getRequest()->sendFile('a.csv', $content, "text/csv", false);

	exit();



    public function actionOrderdownload()
    {
        $searchModel = new \app\models\MOrderSearch;
        $dataProvider = $searchModel->search($_GET);
        $attributes = ['oid', 'office_id', 'office.title', 'openid', 'detail', 'feesum', 'select_mobnum', 'create_time', 'userid', 'username', 'usermobile', 'status', 'pay_kind', 'memo'];
//        $attributes = ['oid', 'office_id', 'openid', 'detail', 'feesum', 'select_mobnum', 'create_time', 'userid', 'username', 'usermobile', 'status', 'pay_kind', 'memo'];
//        foreach ($attributes as $attribute)
//            $headers[] = $row->getAttributeLabel($attribute);

        //$dataProvider->query->select($attributes);
        $dataProvider->setPagination(false);
        $data = $dataProvider->getModels();

//        $query = clone $dataProvider->query;
//        $data = $query->asArray()->all($dataProvider->db);
//        U::W($data);

        $date = date('Y-m-d-His');
        $filename = Yii::$app->getRuntimePath()."/order-{$date}.csv";
        $csv = new \app\models\ECSVExport($data);
        $csv->setInclude($attributes);                
//        $csv->setExclude(['gh_id','iid','pay_kind','val_pkg_3g4g']);                
//        $csv->setHeaders(['Office Id'=>'MyOfficeId', 'Memo'=>'MyMemo']);
        $csv->toCSV($filename); 
        Yii::$app->response->sendFile($filename);
        return;
    }

	
*/

class ECSVExport
{
    /**
     * show column headers in csv file
     * @var boolean $includeColumnHeaders
     */
    public $includeColumnHeaders = true;
    
    /**
     * sometimes excel chokes on newlines in string, this will fix that
     * @var boolean $replaceNewLines strip newlines from each column
     */
    public $stripNewLines = true;
    
    /**
     * run through whole resultset, appending to output stream, using paging (if on)
     * @var boolean $exportFull
     */
    public $exportFull = true;
    
    /**
     * convert activedata provider to a cdbcommand for speed
     * @var boolean $convertActiveDataProvider
     */
    public $convertActiveDataProvider = true;
    
    /**
     *
     * string filename
     * @var string $_outputFile 
     */
    protected $_outputFile;
    
    /**
     * stream pointer
     * @var resource $_filePointer
     */
    protected $_filePointer;
    
    /**
     * data provider that will generate or contain resultset
     * @var mixed SqlDataProvider|Array|ActiveDataProvider|Command $_dataProvider
     */
    protected $_dataProvider;
    
    /**
     * per row callable function
     * @var callable $_callback
     */    
    protected $_callback;
    
    /**
     * csv headers
     * @var array $_headers 
     */
    protected $_headers = array();
    
    /**
     *
     * columns to exclude from final file
     * @var array $_exclude 
     */
    protected $_exclude = array();

    protected $_include = array();

    /**
     * column delimiter
     * @var string $_delimiter 
     */
    protected $_delimiter = ",";
    
    /**
     * string to enclose fields when delimiter is found in field
     * @var string $_enclosure 
     */
    protected $_enclosure = '"';
    
    /**
     * determine if overwriting output file or just append to existing
     * $this->setToAppend()
     * @var boolean
     */
    protected $_appendCsv = false;
    
    /**
     * extra model relations to include in output, cause normally it only
     * gets the attributes for the current model. ooops
     * array('buyer'=>'name'... or 'buyer'=>array('rel1','rel2'))
     * @var array 
     */
    protected $_modelRelations = array();
    
    /**
     *
     * @param mixed $dataProvider array|SqlDataProvider|ActiveDataProvider|Command
     * @param boolean $exportFull
     * @param boolean $includeColumnHeaders
     * @param string $delimiter
     * @param string $enclosure 
     */    
    public function __construct($dataProvider, $exportFull=true, $includeColumnHeaders=true, $delimiter=null, $enclosure=null) 
    {
        $this->_dataProvider = $dataProvider;
        $this->exportFull = (bool) $exportFull;
        $this->includeColumnHeaders = (bool) $includeColumnHeaders;
        if($delimiter) $this->_delimiter = $delimiter;
        if($enclosure) $this->_enclosure = $enclosure;
    }
    
    /**
     * get data provider
     * @return mixed $this->_dataProvider
     */
    public function getDataProvider()
    {
        return $this->_dataProvider;
    }
    
    /**
     * call this function to not force ActiveDataProvider to be converted to command
     * for speed and memory at the expense of losing the with() functionality
     *
     * @return \ECSVExport 
     */
    public function dontConvertProvider()
    {
        $this->convertActiveDataProvider = false;
        return $this;
    }
    
    /**
     * sets flag to have it append to file instead of just overwriting it
     * @return void 
     */
    public function setToAppend()
    {
        $this->_appendCsv = true;
        return $this;
    }
    
    /**
     *
     * set csv delimiter, defaults to ,
     * @param type $delimiter
     * @return \ECSVExport 
     */
    public function setDelimiter($delimiter)
    {
        $this->_delimiter = $delimiter;
        return $this;
    }
    
    /**
     * get current delimiter
     * @return type 
     */
    public function getDelimiter()
    {
        return $this->_delimiter;
    }
    
    /**
     *
     * set csv enclosure, defaults to "
     * @param type $enclosure
     * @return \ECSVExport 
     */
    public function setEnclosure($enclosure)
    {
        $this->_enclosure = $enclosure;
        return $this;
    }
    
    /**
     *
     * @return string
     */
    public function getEnclosure()
    {
        return $this->_enclosure;
    }
    
    /**
     *
     * set filename of csv file you want to create
     * @param type $filename
     * @return \ECSVExport 
     */
    public function setOutputFile($filename)
    {
        $this->_outputFile = $filename;
        return $this;
    }
    
    /**
     * get output file
     * @return string
     */
    public function getOutputFile()
    {
        return $this->_outputFile;
    }
       
    /**
     * function to be called for each row in set
     * @param mixed callable|array $callback
     * @return \ECSVExport
     * @throws Exception on uncallable variable
     */
    public function setCallback($callback)
    {
        if(is_callable($callback)) {
            $this->_callback = $callback;
            return $this;
        } else {
            throw new Exception('Callback must be callable. Duh.');
        }
    }
    
    /**
     * get per row function    
     * @return mixed $this->_callback
     */
    public function getCallback()
    {
        return $this->_callback;
    }
    
    /**
     * existing column names remapped to other strings resultcolumn=>new name
     * @param array $headers
     * @return \ECSVExport 
     */
    public function setHeaders(array $headers)
    {
        $this->_headers = $headers;
        return $this;
    }
    
    /**
     * get current csv headers
     * @return array $this->_headers
     */
    public function getHeaders()
    {
        return $this->_headers;
    }
    
    /**
     *
     * @param string $key
     * @param string $value
     * @return \ECSVExport 
     */
    public function setHeader($key, $value)
    {
        $this->_headers[$key] = $value;
        return $this;
    }
    
    /**
     *
     * @param type $noshow
     * @return \ECSVExport 
     */
    public function setExclude($noshow)
    {
        if(is_array($noshow)) {
            $this->_exclude = $noshow;
            return $this;
        } else {
            $this->_exclude[] = (string) $noshow;
        }
    }
    
    /**
     * get excluded fields
     * @return array $this->_exclude
     */
    public function getExclude()
    {
        return $this->_exclude;
    }

    public function setInclude($arr)
    {
            $this->_include = $arr;
            return $this;
    }
    
    public function getInclude()
    {
        return $this->_include;
    }

    /**
     * get the set model relations
     * return array $this->_modelRelations 
     */
    public function getModelRelations()
    {
        return $this->_modelRelations;
    }
    
    /**
     * set relations to include on output that will be interpolated via model crap
     * needs to be array of arrays
     * @param array $relations 
     */
    public function setModelRelations(array $relations)
    {
        $this->_modelRelations = $relations;
    }
    
    /**
     * turn off going through whole resultset, taking current page into account
     * @return \ECSVExport 
     */
    public function exportCurrentPageOnly()
    {
        $this->exportFull = false;
        return $this;
    }
    
    /**
     * create a csv string, or file if $outputFile is set
     * 
     * @param string $outputFile
     * @param string $delimiter
     * @param string $enclosure
     * @param boolean $includeHeaders
     * @return mixed string|boolean|integer csv string when no outputFile is specified
     * boolean if the writing failed, or integer of num bytes written to file 
     */
    public function toCSV($outputFile=null, $delimiter=null, $enclosure=null, $includeHeaders=true)
    {
        // check that data provider is something useful
        $isGood = false;
        
        if($this->_dataProvider instanceof ActiveDataProvider) {
            $isGood = true;
        }
        
        if($this->_dataProvider instanceof SqlDataProvider) {
            $isGood = true;
        }
        
        if($this->_dataProvider instanceof Command) {
            $isGood = true;
        }
        
        if(is_array($this->_dataProvider)) {
            $isGood = true;
        }
        
        if(!$isGood) {
            throw new Exception('Bad data provider given as source to '.__CLASS__);
        }
        
        if($outputFile !== null) {
            $this->setOutputFile($outputFile);
        }
        
        if(!$includeHeaders) {
            $this->includeColumnHeaders = false;
        }
        
        if($delimiter !== null) {
            $this->_delimiter = $delimiter;
        }
        
        if($enclosure !== null) {
            $this->_enclosure = $enclosure;
        }
        
        // create file pointer
        $this->_filePointer =  fopen("php://temp", 'w');

		
        // added by hehbhehb for BOM utf-8 begin, excel打开utf8文件时中文显示乱码, 还得在前面添加一个bom头，也就是说文件必须是utf8+bom时,在excel中才能正常显示汉字
        //fwrite($this->_filePointer, "\xEF\xBB\xBF");
        //end

        $this->_writeData();        
        rewind($this->_filePointer);
        
        // make sure you can write to file!
        if($this->_outputFile !== null) {
            // write stream to file
            return $this->_appendCsv ? file_put_contents($this->_outputFile, $this->_filePointer, FILE_APPEND | LOCK_EX) 
                                     : file_put_contents($this->_outputFile, $this->_filePointer, LOCK_EX);
            
        } else {
            return stream_get_contents($this->_filePointer);    
        }
    }
    
    /**
     * where the magic happens. depending on type of dataProvider, it uses
     * different methods to get the data efficiently and to write to file
     * pointer in memory. the most effecient is either a small array or
     * by just passing in a Command instance 
     * @throws Exception - no data found
     */
    protected function _writeData()
    {        
        $firstTimeThrough = true;    
/*        
        if($this->_dataProvider instanceof ActiveDataProvider) { 
            if($this->exportFull) {
                // set pagination to off
                $this->_dataProvider->setPagination(false);
            }
            if($this->convertActiveDataProvider) {
                $criteria = $this->_dataProvider->getCriteria();
                $model = $this->_dataProvider->model;
                $criteria = $model->getCommandBuilder()
                                    ->createCriteria($criteria,array());
                $this->_dataProvider = $model->getCommandBuilder()
                                             ->createFindCommand($model->getTableSchema(), 
                                                                 $criteria);                                
                unset($model, $criteria);
            } else {
                // suggested implementation from marcovtwout	
                $models = $this->_dataProvider->getData();
                $dataReader = array();
                $attributes = $this->_dataProvider->model->getMetaData()->columns;
                
                
                // since we are already looping through results, don't bother
                // passing results to _loopRow, just write it here.
                foreach ($models as &$model) {
                    $row = array();
                    
                    foreach ($attributes as $attribute => $col) {
                        $row[$attribute] = $model->{$attribute};
                    }
                    
                    // check model relations
                    if(count($this->_modelRelations)) {
                        foreach($this->_modelRelations as $relation=>$value) {
                            if(is_array($value)) {
                                foreach($value as $subvalue) {
                                    if(isset($model->$relation->$subvalue) && $model->$relation->$subvalue)
                                        $row[$relation.'['.$subvalue.']'] = $model->$relation->$subvalue;
                                }
                            } else {
                                if(isset($model->$relation->$value) && $model->$relation->$value)
                                    $row[$relation.'['.$value.']'] = $model->$relation->$value;
                            }
                        }
                    }
                    
                    if($firstTimeThrough) {
                        $this->_writeHeaders($row);
                        $firstTimeThrough = false;                    
                    }
                    $this->_writeRow($row);
                }
                unset($models, $attributes);
                return;
            }            
        }
        
        if($this->_dataProvider instanceof SqlDataProvider) {            
            if($this->exportFull) {
                $this->_dataProvider->setId('csvexport');
                $this->_dataProvider->getPagination()->setItemCount($this->_dataProvider->getTotalItemCount());                
                $pageVar = $this->_dataProvider->getPagination()->pageVar;
                $_GET[$pageVar] = 0;                
                $totalPages = $this->_dataProvider->getPagination()->getPageCount();                
                $this->setToAppend();
                for($i=1; $i<=$totalPages; $i++) {                    
                    $_GET[$pageVar] = $i;
                    $this->_dataProvider->getPagination()->setCurrentPage($i); 
                    $_getData = $this->_dataProvider->getData(true);
                    $this->_loopRows($_getData);                    
                    $this->includeColumnHeaders = !(bool) $i;
                }                
            } else {
                $this->_loopRows($this->_dataProvider->getData());
            }
                        
            return;
        }
        
        if($this->_dataProvider instanceof Command) {
            $dataReader = $this->_dataProvider->query();  
            $this->_loopRows($dataReader);            
            return;
        }
*/        
        if(is_array($this->_dataProvider)) {
            $this->_loopRows($this->_dataProvider);
            return;
        } 
        
        // if program made it this far something happened
        throw new Exception('Data source failed to retrieve data, are you sure you passed something useable?');
    }
    
    /**
     * loop through result set
     * @param mixed CDbDataReader|array $dp 
     */
    public function _loopRows(&$dp)
    {
        $firstTimeThrough = true;
/*        
        if($dp instanceof CDbDataReader) {
            while(($row = $dp->read()) !== false) {
                if($firstTimeThrough) {
                    $this->_writeHeaders($row);
                    $firstTimeThrough = false;                    
                }
                $this->_writeRow($row);
            }
        } 
        else 
*/        
        {
            $total = count($dp);
            for($i=0; $i<$total; $i++) {
                if($firstTimeThrough) {
                    $this->_writeHeaders($dp[$i]);
                    $firstTimeThrough = false;                    
                }
                $this->_writeRow($dp[$i]);
            }
        }
    }
    
    /**
     * Write headers to csv file, taking into account string replacements and exclusions     
     * @param array $row
     * @return void 
     */
    protected function _writeHeaders($row)
    {
        if(!$this->includeColumnHeaders) {
            return;
        }
        
        if($row instanceof ActiveRecord) 
        {
            if(count($this->_include) > 0) 
            {
                foreach ($this->_include as $attribute) 
                {
                    $headers[] = $row->getAttributeLabel($attribute);
                }            
            }
            else
            {
                foreach ($row->attributes() as $attribute) 
                {
                    $headers[] = $row->getAttributeLabel($attribute);
                }
            }
        } else {
            $headers = array_keys($row);
        }

        // remove excluded
        if(count($this->_exclude) > 0) {
            foreach($this->_exclude as $e) { 
                $key = array_search($e, $headers);
                if($key !== false) {                    
                    unset($headers[$key]);                        
                }
            }
        }            

        if(count($this->_headers) > 0) {
            foreach($headers as &$header) {
                if(array_key_exists($header, $this->_headers)) {
                    $header = $this->_headers[$header];             
                }
            }
        }     

        //added by hehb begin
        $headers = $this->getGbkRows($headers);
        //end
        fputcsv($this->_filePointer, $headers, $this->_delimiter, $this->_enclosure);
    }
    
    /**
     * Write array row to current {$this->_filePointer}, taking into account exclusions
     * @param array $row 
     * @return void
     */
    public function _writeRow($row)
    {
        if($row instanceof ActiveRecord) 
        {
            if(count($this->_include) > 0) 
            {
                foreach ($this->_include as $attribute)
                {               
                    if (strpos($attribute, '.') !== false)
                    {
                        $v = $row;
                        $attributeParts = explode('.', $attribute);
                        foreach ($attributeParts as $a)
                        {
                            if (empty($v->{$a}))
                            {
                                $v = '';
                                break;
                            }
                            else
                                $v = $v->{$a};
                        }      
                        $arr[$attribute] = $v;
                    }
                    else
                        $arr[$attribute] = $row->{$attribute};

                }                               
                $row = $arr;
            }   
            else            
                $row = $row->getAttributes();
//             $row = $row->getAttributes($this->_include);
        }

        // remove excluded
        if(count($this->_exclude) > 0) {
            foreach($this->_exclude as $e) { 
                if(array_key_exists($e, $row)) {
                    unset($row[$e]);
                }
            }
        }

        if($this->stripNewLines) {            
            array_walk($row, array('\app\models\ECSVExport','lambdaFail'));
        }
        
        array_walk($row, array('\app\models\ECSVExport','stripSlashes'));

        //added by hehb begin        
        $row = $this->getGbkRows($row);        
        //end
        
        if(isset($this->_callback) && $this->_callback) {
            fputcsv($this->_filePointer, call_user_func($this->_callback, $row), $this->_delimiter, $this->_enclosure);                       
        } else {
            fputcsv($this->_filePointer, $row, $this->_delimiter, $this->_enclosure);
        }
        unset($row);
    }
	
	public static function lambdaFail(&$value, $key)
	{
		$value = str_replace("\r\n"," ", $value);
	}
    
    public static function stripSlashes(&$value, $key)
    {
        $value = stripslashes($value);
        $value = str_replace('\"', '"', $value);
    }

    public function getGbkRows($arr)
    {
        $rows = [];
        foreach ($arr as $i => $v) {
            if (function_exists ('mb_convert_encoding')) {
                $rows[$i] = mb_convert_encoding($v, "GBK", "UTF-8");
            } else {
                $rows[$i] = iconv("UTF-8","GBK//IGNORE", $v);
            }
        }     
        return $rows;
    }
    
}
