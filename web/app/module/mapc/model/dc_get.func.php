<?php
	if(!defined('__MAPC__')) { exit(); }

	/**
	 * 더블린 코어 파일 가져오기
     *
     * @param string $option['slug'] 파일 명
     * @param string $option['dir']  파일 경로
	 */

	function module_mapc_dc_get($file_name, $option = array()) {

		if(is_file($file_name)) {

			$RDF = file_get_contents($file_name);

		} else {

			return false;

		}

		$RDF = str_replace('rdf:',   'rdf_', $RDF);
		$RDF = str_replace('dc:',    'dc_',  $RDF);
		$RDF = str_replace('xsi:',   'xsi_', $RDF);
		$RDF = str_replace('xmlns:', 'xsi_', $RDF);

		$XML = simplexml_load_string($RDF);

        $namespaces = $XML->getNameSpaces(true);
        $dc = $XML->children($namespaces['dc']);

		return $dc->rdf_Description;

	}

// this is is
