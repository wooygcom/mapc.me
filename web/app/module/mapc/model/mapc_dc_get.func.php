<?php
	if(!defined('__MAPC__')) { exit(); }

	/**
	 * 더블린 코어 파일 가져오기
     *
     * @param string $option['slug'] 파일 명
     * @param string $option['dir']  파일 경로
	 */

	function mapc_dc_get($uid, $option = array()) {

        $slug = $option['slug'];
        $dir  = $option['dir'];

		$rdf_file = $dir . $slug . '.rdf';

		if(is_file($rdf_file)) {

			$RDF = file_get_contents($rdf_file);

		} else {

			return false;

		}

		$RDF = str_replace('rdf:', 'rdf_', $RDF);
		$RDF = str_replace('dc:', 'dc_', $RDF);

		$XML = simplexml_load_string($RDF);

		$result['rdf_about']	= $XML->rdf_Description->attributes()->rdf_about[0];
		$result['dc_title']	= $XML->rdf_Description->dc_title;
		$result['dc_creator']	= $XML->rdf_Description->dc_creator;
		$result['dc_subject']	= $XML->rdf_Description->dc_subject;
		$result['dc_description']	= $XML->rdf_Description->dc_description;
		$result['dc_contributor']	= $XML->rdf_Description->dc_contributor;
		$result['dc_publisher']	= $XML->rdf_Description->dc_publisher;
		$result['dc_identifier']	= $XML->rdf_Description->dc_identifier;
		$result['dc_relation']	= $XML->rdf_Description->dc_relation;
		$result['dc_source']	= $XML->rdf_Description->dc_source;
		$result['dc_rights']	= $XML->rdf_Description->dc_rights;
		$result['dc_format']	= $XML->rdf_Description->dc_format;
		$result['dc_type']	= $XML->rdf_Description->dc_type;
		$result['dc_date']	= $XML->rdf_Description->dc_date;
		$result['dc_coverage']	= $XML->rdf_Description->dc_coverage;
		$result['dc_language']	= $XML->rdf_Description->dc_language;

		return $result;

	}

// this is is
