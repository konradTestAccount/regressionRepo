    <?php 
    $queryCourseCompare = $queryHandlerCourseCompare->getQueryValuesForPrint();
    $resultsCourseCompare = count($searchCourseCompare->getDocumentResults()) ? $documentCollectionCourseCompare->returnArrayResults() : [];     
    ?>
    <div id="coursecompare-box" role="search" data-t4-ajax-group="courseCompare" compare-min="<?php echo $configCourseCompare['min'] ?>" compare-max="<?php echo $configCourseCompare['max'] ?>">
        <form class="course-compare-form" method="GET" action="<?php echo $mainLibraryUrlCompare ?>">

            <div id="checkboxes-coursecompare" class="columns-full">
                <div class="panel callout course-search-widget">
                    <fieldset >
                        <legend class="h4">
                            <a href="#<?php echo 'courseList' ?>">
                            <?php echo count($resultsCourseCompare) == 1 ? '1 Saved Program' : (count($resultsCourseCompare) == 0 ? 'No Saved Program' : count($resultsCourseCompare).' Saved Courses') ?>
                            </a></legend>
                        <?php if (count($resultsCourseCompare) >= 1) : ?>
                            <div class="course-list" id="courseList">
                            <p>You can compare from a minimum of <?php echo $configCourseCompare['min'] ?> to a maximum of <?php echo $configCourseCompare['max'] ?> programs at the same time.</p>
                            
                                <?php $i = 0; ?>
                                <?php foreach ($resultsCourseCompare as $item) : ?>
                                    <label for="course-<?php echo $item['contentID']; ?>" class="label-text">
                                        <input type="checkbox" id="course-<?php echo $item['contentID']; ?>" name="compare_course[]" value="<?php echo $item['contentID']; ?>" <?php echo isset($queryCourseCompare['compare_course[]']) && in_array($item['contentID'], is_array($queryCourseCompare['compare_course[]']) ?  $queryCourseCompare['compare_course[]'] : array($queryCourseCompare['compare_course[]'])) ? 'checked' : '' ?> />
                                        <span><?php echo $item['courseName']; ?><br />
                                        <strong>Level:</strong> <?php echo $item['courseType']; ?></span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                            <input class="button small secondary expand" type="submit" value="Compare Programs" />
                        <?php endif; ?>
                    </fieldset>
                </div>
            </div>
        </form>
    </div>



