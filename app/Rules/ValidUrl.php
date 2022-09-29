<?php

namespace App\Rules;
use Illuminate\Contracts\Validation\Rule;


class ValidUrl implements Rule
{
     /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
    */
    public function passes($attribute, $value)
    {
      return $this->is_valid_Url($value);    
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __("Invalid Url");
    }
    
    /**
     * Validate URL using DNS.
     */
    private function is_valid_url($url){
              
      $valid = false;

      /*Parse URL*/
      $urlparts = parse_url(filter_var($url, FILTER_SANITIZE_URL));
      /*Check host exist else path assign to host*/
      if(!isset($urlparts['host'])){
        $urlparts['host'] = $urlparts['path'];
      }

      if($urlparts['host']!=''){

        /*Add scheme if not found*/
        if (!isset($urlparts['scheme'])){
           return false;
        }

       /*Validation*/
       if(checkdnsrr($urlparts['host'], 'A') && in_array($urlparts['scheme'],array('http','https')) && ip2long($urlparts['host']) === FALSE){ 
            $urlparts['host'] = preg_replace('/^www\./', '', $urlparts['host']);
            $url = $urlparts['scheme'].'://'.$urlparts['host']. "/";            
            
            if (filter_var($url, FILTER_VALIDATE_URL) !== false && @get_headers($url)) {
                return true;
            }
        }
      }

     return false;
    }

}
