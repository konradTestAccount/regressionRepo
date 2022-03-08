<?php 
    $genericFacet = \T4\PHPSearchLibrary\FacetFactory::getInstance('GenericFacet', $documentCollection, $queryHandler);
    $filters = $queryHandler->getQueryValuesForPrint();
    $categoryFilters = array('type','title','department');
    $dateFilters = array();
    $rangeFilters = array();
?>
<div role="search" data-t4-ajax-group="directorySearch" id="searchGeneric">
    <form method="get">
        <div id="keywordKeywords" class="columns-full">
            <div class="panel course-search-widget">

                <fieldset>
                    <legend>Filter for keywords</legend>
                    <div id="searchField">
                        <label for="keywords">Filter for keyword</label>
                        <input type="text" id="search" name="keywords" placeholder="e.g. Robert"
                               value="<?php echo !empty($query['keywords']) ? $query['keywords']: ''  ?>">

                    </div>
                    <noscript>
                        <button type="submit" class="button small secondary expand">Search by keyword</button>
                    </noscript>
                    <div id="hiddenGeneric" data-t4-ajax-group="directorySearch">
                        <?php
                                // Output the current 'keyword' query as hidden input so it's preserved when updating results
                                $formatQueryAsHiddenInput = \T4\PHPSearchLibrary\QueryFormatterFactory::getInstance('FormatQueryAsHiddenInput', $queryHandler);
                                $formatQueryAsHiddenInput->setMember('excludedQueries', array('keywords', 'page'));
                                echo $formatQueryAsHiddenInput->format();
                            ?>
                    </div>
                </fieldset>
            </div>
        </div>
    </form>
</div>
<div id="searchResults" class="staff-directory" role="main" data-t4-ajax-group="directorySearch">
    <div class="small-12 atoz" id="staffAtoZ">
        <h3 class="hidden">Filter by A to Z</h3>
        <div class="button-list">
            <?php
            $element = 'lastname';
            $genericFacet->setMember('element', $element);
            $genericFacet->setMember('type', 'AtoZ');
            $genericFacet->setMember('facetSource', 'documents');
            $search = $genericFacet->displayFacet();
            ?>
            <?php if (!empty($search)) : ?>
            <form action="<?php echo str_replace('/index.php', '/', $_SERVER['SCRIPT_NAME']) ?>" method="get">
                <?php $class = !isset($query['lastname']) && isset($query['showall']) ? 'selected' : ''; ?>
                <button value="1" name="showall" <?php echo !empty($class) ? 'class="' .$class.'"' : '' ?>>All</button>
                <?php foreach ($search as $item) : ?>
                <?php $class = $item['selected'] ? 'selected' : ''; ?>
                <button name="<?php echo $element ?>" value="<?php echo $item['value'] ?>"
                        <?php echo !empty($class) ? 'class="' .$class.'"' : '' ?>><?php echo $item['label'] ?></button>
                <?php endforeach; ?>
                <div id="hidden-form-atoz" data-t4-ajax-group="directorySearch">
                    <?php
                    // Output the current 'keyword' query as hidden input so it's preserved when updating results
                    $formatQueryAsHiddenInput = \T4\PHPSearchLibrary\QueryFormatterFactory::getInstance('FormatQueryAsHiddenInput', $queryHandler);
                    $formatQueryAsHiddenInput->setMember('excludedQueries', array( 'page', 'lastname'));
                    echo $formatQueryAsHiddenInput->format();
                    ?>
                </div>
            </form>
            <?php endif; ?>
        </div>
    </div>
    <?php if ($queryHandler->doQuerysExist() === true || $queryHandler->isQuerySet('showall')) : ?>
    <?php 
    $group = '';
    $currentGroup = '';
    $nextGroup = '';
    ?>
    <?php if (!empty($results)) : ?>
        <?php 
        for ($i = 0; $i < sizeof($results); $i++) :
            $item = $results[$i]; ?>
            <?php
            if ($queryHandler->isQuerySet('department')) {
                $currentGroup = $item['type'];
                $nextGroup = isset($results[$i+1]['type']) ? $results[$i+1]['type'] : '';
            }
            //var_dump($results[$i], $i, $group, $currentGroup, $nextGroup);
            if ($currentGroup !== $group || $i == 0) {
            ?>
                <table class="results">
                    <thead>
                        <tr colspan="4">
                            <h3><?php echo $currentGroup ?></h3>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Department</th>
                            <th>Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  $group = $currentGroup;
            }
            ?>
                        <tr>
                            <td>
                                <a href="#">
                                    <?php echo $item['firstname']; ?> <?php echo $item['lastname']; ?>
                                </a><br />
                                <small><?php echo $item['title']; ?></small>
                            </td>
                            <td><?php echo $item['type']; ?></td>
                            <td><?php echo $item['department']; ?></td>
                            <td><?php echo $item['phone']; ?></td>
                        </tr>
            <?php if ($currentGroup !== $nextGroup || !isset($results[$i+1])) { ?>

                    </tbody>
                </table>
            <?php 
            }
            ?>
        <?php endfor; ?>
    <div class=" pagination-box">
        <div class="pagination-pages">
            <?php if (!empty($paginationArray)) : ?>
            <nav class="pagination" data-t4-ajax-link="normal" data-t4-scroll="true">
                <?php foreach ($paginationArray as $page) : ?>
                <?php if ($page['text'] == "&lt;&lt;") : ?>
                <a href="<?php echo $page['href']; ?>"><?php echo $page['text']; ?></a>
                <?php elseif ($page['text'] == "&gt;&gt;") : ?>
                <a href="<?php echo $page['href']; ?>"><?php echo $page['text'] ; ?></a>
                <?php elseif ($page['text'] == "&lt;") : ?>
                <a href="<?php echo $page['href']; ?>"><?php echo $page['text']; ?></a>
                <?php elseif ($page['text'] == "&gt;") : ?>
                <a href="<?php echo $page['href']; ?>"><?php echo $page['text'] ; ?></a>
                <?php elseif ($page['current'] == true) : ?>
                <span class="currentpage"><?php echo $page['text'] ; ?></span>
                <?php else : ?>
                <a href="<?php echo $page['href']; ?>"><?php echo $page['text'] ; ?></a>
                <?php endif; ?>
                <?php endforeach; ?>
            </nav>
            <?php endif; ?>
        </div>
        <div id="searchPaginate" role="search" data-t4-ajax-group="directorySearch">
            <form action="<?php echo str_replace('/index.php', '/', $_SERVER['SCRIPT_NAME']) ?>" method="get"
                  class="pagination-results">
                <?php if ($paginate > 0) : ?>
                <span class="results">Results <?php echo $resultTo != 0 ? $resultFrom . ' - ' . $resultTo : $resultTo ?>
                    of <?php echo $totalResults ?></span>
                <?php if ((class_exists('T4\PHPSearchLibrary\QueryHandlerFactory\CompareQueryHandler') || class_exists('CompareQueryHandler'))) : ?>
                <?php if (isset($paginateDropdown) && !empty($paginateDropdown)) : ?>
                <select name="paginate">
                    <?php foreach ($paginateDropdown as $page) : ?>
                    <option value="<?php echo $page; ?>" <?php echo $page==$paginate ? 'selected' : '' ; ?>>
                        <?php echo $page === 0 ?  'All' :  $page; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <?php endif; ?>
                <?php endif; ?>
                <?php else : ?>
                <span class="results"><?php echo $totalResults ?> Results</span>
                <?php endif; ?>
                <noscript>
                    <button type="submit" class="button small secondary expand">Change Page</button>
                </noscript>
                <div id="hiddenPaginate" data-t4-ajax-group="directorySearch">
                    <?php
                    // Output the current 'keyword' query as hidden input so it's preserved when updating results
                    $formatQueryAsHiddenInput = \T4\PHPSearchLibrary\QueryFormatterFactory::getInstance('FormatQueryAsHiddenInput', $queryHandler);
                    $formatQueryAsHiddenInput->setMember('excludedQueries', array('paginate', 'page'));
                    echo $formatQueryAsHiddenInput->format();
                    ?>
                </div>
            </form>
        </div>
    </div>
    <?php else : ?>
    <p class="message">No staff members found!</p>
    <?php endif; ?>
    <?php else : ?>
    <p class="message">Use the search box and filters to help find the staff member you're looking for.</p>
    <?php endif; ?>
</div>