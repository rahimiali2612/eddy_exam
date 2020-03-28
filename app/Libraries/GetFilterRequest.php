<?php

namespace App\Libraries;
use Illuminate\Http\Request;

class GetFilterRequest {
  function __construct() {
    $request=Request();
    $this->query_string=$request->all();
  }

  function parse($orm) {
    foreach ($this->query_string as $key => $value) {
      if (substr( $key, 0, 7 ) === "filter_"){
        #$this->sequence_of_filters[substr( $key, 7 )]=$value;
        $orm=$orm->where(substr( $key, 7 ),'like',$value);
      }
    }
    return $orm;
  }

}

?>
