<?php

    mb_http_output('utf-8');
    mb_internal_encoding('utf-8');

    $documentsSource = '<t4 type="navigation" id="57"/>/index.json';
    require_once(realpath($_SERVER['DOCUMENT_ROOT']).'<t4 type="media" id="320"/>');

    error_reporting(E_ALL ^ E_NOTICE);

    try {
        $queryHandler = QueryHandlerFactory::getInstance('AutocompleteQueryHandler', $_GET);
        $queryHandler->handleQuery();
    } catch (UnexpectedValueException $e) {
        $response = new JsonErrorResponse('No Suggested Results');
        $response->send();
    } catch (InvalidArgumentException $e) {
        $response = new JsonErrorResponse('No Suggested Results');
        $response->send();
    }

    try {
        $search = SearchFactory::getInstance('Search', $documentsSource);
        $substringSearch = FilterFactory::getInstance('FilterBySubstring', $search);
    } catch (RuntimeException $e) {
        $response = new JsonErrorResponse('No Suggested Results');
        $response->send();
    } catch (InvalidArgumentException $e) {
        $response = new JsonErrorResponse('No Suggested Results');
        $response->send();
    } catch (LengthException $e) {
        $response = new JsonErrorResponse('No Suggested Results');
        $response->send();
    }

    $substringSearch->setMember('element', 'courseOverview');
    $substringSearch->setMember('query', $queryHandler->getQuery());
    $substringSearch->setMember('combinationOption', true);
    $substringSearch->runFilter();

    $substringSearch->setMember('element', 'courseName');
    $substringSearch->runFilter();
    $search->combineResults();

    $search->intersectDocumentResults();

    try {
        $documentCollection = DocumentCollectionFactory::getInstance('DocumentCollection', $search->getDocuments(), $search->getDocumentResults(), $queryHandler->doQuerysExist());
    } catch (RuntimeException $e) {
        $response = new JsonErrorResponse('No Suggested Results');
        $response->send();
    } catch (UnderflowException $e) {
        $response = new JsonErrorResponse('No Suggested Results');
        $response->send();
    } catch (InvalidArgumentException $e) {
        $response = new JsonErrorResponse('No Suggested Results');
        $response->send();
    }

    if ($documentCollection->wereResultsFound() === false) {
        $response = new JsonErrorResponse('Search for '.$queryHandler->getQueryAsString(), $queryHandler->getQueryAsString());
        $response->send();
    }

    // Instantiate our Processors
    try {
        $frequencySearch = ProcessorFactory::getInstance('FrequencySearch', $documentCollection);
    } catch (RuntimeException $e) {
        $response = new JsonErrorResponse('No Suggested Results');
        $response->send();
    } catch (InvalidArgumentException $e) {
        $response = new JsonErrorResponse('No Suggested Results');
        $response->send();
    }

    $frequencySearch->setMember('element', 'courseOverview');
    $frequencySearch->setMember('query', $queryHandler->getQuery());
    $frequencySearch->runProcessor();
    $documentCollection->combineRankedResults();

    // Sort the document results
    try {
        $documentCollection->sort('rank', SORT_DESC, 'courseName', SORT_ASC);
    } catch (UnderflowException $e) {
        $response = new JsonErrorResponse('No Suggested Results');
        $response->send();
    }

    $results = array();
    $results[0]['label'] = 'Search for "'.$queryHandler->getQueryAsString().'"';
    $results[0]['value'] = $queryHandler->getQueryAsString();

    $i = 1;
    foreach ($documentCollection->getDocumentResults() as $document) {
        $details = $documentCollection->getDocuments();
        $results[$i]['label'] = $details[$document]['courseName'];
        $results[$i]['value'] = $details[$document]['courseName'];
        $i += 1;
    }

    $response = new JsonSuccessResponse($results);
    $response->send();




