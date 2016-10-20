<?php

namespace Yuido\JsonValidator;

use JsonSchema\Validator;

class JsonValidator {
    private $jsonValidator;
    private $jsonSchemaFile;
    
    public function __construct(Validator $jsonValidator, $jsonSchemaFile = null) {
        $this->jsonValidator = $jsonValidator;
        $this->jsonSchemaFile = $jsonSchemaFile;
    }
    
    public function check($jsonObject){
        if(is_null($this->jsonSchemaFile)){
            throw new \Exception('I need a json schema file, use setJsonSchema() to set it');
        }
        
        return $this->jsonValidator->check($jsonObject, 
                (object) ['$ref' => 'file://' . realpath($this->jsonSchemaFile)]); 
    }
    
    public function isValid(){
        return $this->jsonValidator->isValid();
    }
    
    public function getErrors(){
        return $this->jsonValidator->getErrors();
    }


    public function setJsonSchemaFile($jsonSchemaFile){
        $this->jsonSchemaFile = $jsonSchemaFile;
    }
    
    public function getJsonSchemaFile(){
        return $this->jsonSchemaFile;
    }
}
