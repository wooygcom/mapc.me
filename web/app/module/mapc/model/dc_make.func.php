<?php
/**
 * 더블린 코어화일 만들기
 *
 * @param string $save_dir  저장할 디렉토리
 * @param string $file_name 화일이름
 * @param array  $value 저장하려는 값들
 */

function module_mapc_dc_make($file_name, $value, $save_dir = '') {
    $tmp_dir_name = (PHP_OS == 'WINNT') ? str_replace("/", "\\", $save_dir) : $save_dir;
    @mkdir($tmp_dir_name, 0777);

    $fp = fopen($tmp_dir_name . $file_name, 'w');

    $doc = new DOMDocument('1.0', 'utf-8');
    $doc->formatOutput = true;

    $root = $doc->createElement('rdf:RDF');
    $doc->appendChild($root);

    $root_attr = $doc->createAttribute('xmlns:rdf');
    $root_attr->value = 'http://www.w3.org/1999/02/22-rdf-syntax-ns#';
    $root->appendChild($root_attr);
    $root_attr = $doc->createAttribute('xmlns:dc');
    $root_attr->value = 'http://purl.org/dc/elements/1.1/';
    $root->appendChild($root_attr);
    $root_attr = $doc->createAttribute('xmlns:dcterms');
    $root_attr->value = 'http://purl.org/dc/terms/';
    $root->appendChild($root_attr);

    $desc = $doc->createElement('rdf:Description');
    $root->appendChild($desc);

    $desc_attr = $doc->createAttribute('rdf:about');
    $desc_attr->value = $value['rdf_about'];
    $desc->appendChild($desc_attr);

    if(!empty($value['dc_title'])) {
        foreach($value['dc_title'] as $key => $var) {
            if( ! empty($var) ) {
                $title = $doc->createElement('dc:title', $var);
                $title = $desc->appendChild($title);
            }
        }
    }

    if(!empty($value['dc_identifier'])) {
        foreach($value['dc_identifier'] as $key => $var) {
            if( ! empty($var) ) {
                $identifier = $doc->createElement('dc:identifier', $var);
                $identifier = $desc->appendChild($identifier);
            }
        }
    }

    if(!empty($value['dc_description'])) {
        foreach($value['dc_description'] as $key => $var) {
            if( ! empty($var) ) {
                $description = $doc->createElement('dc:description', $var);
                $description = $desc->appendChild($description);
            }
        }
    }

    if(!empty($value['dc_subject'])) {
        foreach($value['dc_subject'] as $key => $var) {
            if( ! empty($var) ) {
                $subject = $doc->createElement('dc:subject', $var);
                $subject = $desc->appendChild($subject);
                if(! empty($value['dc_subject_id'][$key])) {
                    $subject_attr = $doc->createAttribute('xsi:type');
                    $subject_attr->value = 'mapc:' . $value['dc_subject_id'][$key];
                    $subject = $subject->appendChild($subject_attr);
                }
            }
        }
    }

    if(!empty($value['dc_contributor'])) {
        foreach($value['dc_contributor'] as $key => $var) {
            if( ! empty($var) ) {
                $contributor = $doc->createElement('dc:contributor', $var);
                $contributor = $desc->appendChild($contributor);
            }
        }
    }

    if(!empty($value['dc_language'])) {
        foreach($value['dc_language'] as $key => $var) {
            if( ! empty($var) ) {
                $language = $doc->createElement('dc:language', $var);
                $language = $desc->appendChild($language);
            }
        }
    }

    if(!empty($value['dc_format'])) {
        foreach($value['dc_format'] as $key => $var) {
            if( ! empty($var) ) {
                $format = $doc->createElement('dc:format', $var);
                $format = $desc->appendChild($format);
            }
        }
    }

    if(!empty($value['dc_type'])) {
        foreach($value['dc_type'] as $key => $var) {
            if( ! empty($var) ) {
                $type = $doc->createElement('dc:type', $var);
                $type = $desc->appendChild($type);
                if(! empty($value['dc_type_id'][$key])) {
                    $type_attr = $doc->createAttribute('xsi:type');
                    $type_attr->value = 'mapc:' . $value['dc_type_id'][$key];
                    $type = $type->appendChild($type_attr);
                }
            }
        }
    }

    if(!empty($value['dc_date'])) {
        foreach($value['dc_date'] as $key => $var) {
            if( ! empty($var) ) {
                $date = $doc->createElement('dc:date', $var);
                $date = $desc->appendChild($date);
            }
        }
    }

    if(!empty($value['dc_created'])) {
        foreach($value['dc_created'] as $key => $var) {
            if( ! empty($var) ) {
		        $created = $doc->createElement('dc:created', $var);
		        $created = $desc->appendChild($created);
			}
		}
    }

    if(!empty($value['dc_modified'])) {
        foreach($value['dc_modified'] as $key => $var) {
            if( ! empty($var) ) {
		        $modified = $doc->createElement('dc:modified', $var);
		        $modified = $desc->appendChild($modified);
			}
		}
    }

    if(!empty($value['dc_creator'])) {
        foreach($value['dc_creator'] as $key => $var) {
            if( ! empty($var) ) {
                $creator = $doc->createElement('dc:creator', $var);
                $creator = $desc->appendChild($creator);
            }
        }
    }

    if(!empty($value['dc_publisher'])) {
        foreach($value['dc_publisher'] as $key => $var) {
            if( ! empty($var) ) {
                $publisher = $doc->createElement('dc:publisher', $var);
                $publisher= $desc->appendChild($publisher);
            }
        
        }
    }

    if(!empty($value['dc_relation'])) {
        foreach($value['dc_relation'] as $key => $var) {
            if( ! empty($var) ) {
                $relation = $doc->createElement('dc:relation', $var);
                $relation = $desc->appendChild($relation);
            }
        }
    }

    if(!empty($value['dc_rights'])) {
        foreach($value['dc_rights'] as $key => $var) {
            if( ! empty($var) ) {
                $rights = $doc->createElement('dc:rights', $var);
                $rights = $desc->appendChild($rights);
            }
        }
    }

    if(!empty($value['dc_source'])) {
        foreach($value['dc_source'] as $key => $var) {
            if( ! empty($var) ) {
                $source = $doc->createElement('dc:source', $var);
                $source = $desc->appendChild($source);
            }
        }
    }

    if(!empty($value['dc_coverage'])) {
        foreach($value['dc_coverage'] as $key => $var) {
            if( ! empty($var) ) {
                $coverage = $doc->createElement('dc:coverage', $var);
                $coverage = $desc->appendChild($coverage);
            }
        }
    }

    $contents = $doc->saveXML();

    fwrite($fp, $contents);
    fclose($fp);
}

// this is it
