<div id="searchoptionsGeneric" role="search" data-t4-ajax-group="courseSearch" aria-label="Generic Search">
    <form method="get">
        <div class="panel course-search-widget">
            <fieldset>
                <legend>Filter for programs</legend>
                <!-- Autocomplete Advanced -->
                <div id="search-field"
                     <?php echo isset($config['autocomplete']) ? 'role="combobox" aria-haspopup="listbox" aria-expanded="false"' : ''; ?>>
                    <label for="search">Filter for programs</label>
                    <input type="text" id="search" name="keywords" placeholder="Search by Keyword"
                           value="<?php echo !empty($query['keywords']) ? $query['keywords']: ''  ?>"
                           <?php echo isset($config['autocomplete']) ? 'data-t4-autocomplete-url="'.$config['autocomplete'].'" autocomplete="off" aria-autocomplete="list"' : ''; ?>>
                </div>
                <!-- / Autocomplete Advanced -->
                <noscript>
                    <button type="submit" class="button small secondary expand">Search by keyword</button>
                </noscript>
                <div id="hidden-form-generic" data-t4-ajax-group="courseSearch">
                    <?php
                        $formatQueryAsHiddenInput = \T4\PHPSearchLibrary\QueryFormatterFactory::getInstance('FormatQueryAsHiddenInput', $queryHandler);
                        $formatQueryAsHiddenInput->setMember('excludedQueries', array('keywords', 'page'));
                        echo $formatQueryAsHiddenInput->format();
                ?>
                </div>
            </fieldset>
        </div>
    </form>
</div>
<div id="search-results" role="main" data-t4-ajax-group="courseSearch">
    <?php if (!empty($results)) : ?>
    <?php foreach ($results as $item) : ?>
    <div class='course-listing row'>
        <div class='course-listing-data column medium-9'>
            <div class="h3">
                <a href='<?php echo $item['courseURL']; ?>'>
                    <?php echo $item['courseName']; ?>
                </a>
                <em><?php echo $item['courseCode']; ?></em>
            </div>
            <p>
                <?php 
                $maxDesc = 285;
                echo strlen($item['courseOverview']) > $maxDesc ? substr($item['courseOverview'], 0, $maxDesc-3).'...' : $item['courseOverview'];
            ?></p>
            <ul class='no-bullet'>
                <li>
                    <span>Level</span>:
                    <span data-catlink="" data-catname="courseType" data-separator=",">
                        <?php echo $item['courseType']; ?>
                    </span>
                </li>
                <li>
                    <span>Departments</span>:
                    <span data-catlink="" data-catname="courseDepartments" data-separator=",">
                        <?php echo $item['courseDepartments']; ?>
                    </span>
                </li>
                <li>
                    <span>Duration</span>:
                    <span data-catlink="" data-catname="courseDuration" data-separator=",">
                        <?php echo $item['courseDuration']; ?>
                    </span>
                </li>
                <li>
                    <span>Campus</span>:
                    <span data-catlink="" data-catname="courseLocation" data-separator="," data-child-separator=">"
                          data-child-to=": ">
                        <?php echo $item['courseLocation']; ?>
                    </span>
                </li>
            </ul>
        </div>
        <!-- Program Compare Save Button -->
        <?php if (isset($savedCourses)) : ?>
        <div class=" column medium-3">
            <a href="?<?php echo in_array($item['contentID'], $savedCourses) ? "removeCourse" : "addCourse" ?>=<?php echo $item['contentID']; ?>"
               data-t4-compare-button="save" class="course-<?php echo $item['contentID']; ?>"
               aria-pressed="<?php echo in_array($item['contentID'], $savedCourses) ? "true" : "false" ?>"
               aria-label="Save  <?php echo htmlentities($item['courseName']); ?> Program for Program Compare"
               role="button">
                <?php echo in_array($item['contentID'], $savedCourses) ? "<span class='fa fa-check'></span> Saved" : "<span class='fa fa-plus'></span> Save" ?>
            </a>
        </div>
        <?php endif; ?>
        <!-- / Program Compare Save Button -->
    </div>
    <?php endforeach; ?>
    <!-- Pagination-->
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

        <!-- Pagination Results-->
        <div id="searchPaginate" role="search" data-t4-ajax-group="directorySearch" aria-label="Change Pagination">
            <form action="<?php echo $mainLibraryUrl ?>" method="get" class="pagination-results">
                <?php if ($paginate > 0) : ?>
                <span class="results">Results <?php echo $resultTo != 0 ? $resultFrom . ' - ' . $resultTo : $resultTo ?>
                    of <?php echo $totalResults ?></span>
                <?php else : ?>
                <span class="results"><?php echo $totalResults ?> Results</span>
                <?php endif; ?>
                <?php if (isset($paginateDropdown) && !empty($paginateDropdown)) : ?>
                <select name="paginate">
                    <?php foreach ($paginateDropdown as $page) : ?>
                    <option value="<?php echo $page; ?>" <?php echo $page==$paginate ? 'selected' : '' ; ?>>
                        <?php echo $page === 0 ?  'All' :  $page; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
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
        <!-- / Pagination Results-->
    </div>
    <!-- / Pagination-->
    <?php else : ?>
    <p>No Results Found</p>
    <?php endif;?>
</div>
