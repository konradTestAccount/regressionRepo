    <?php 
	$queryCourseCompare = $queryHandlerCourseCompare->getQueryValuesForPrint();
    $allResultsCourseCompare = count($searchCourseCompare->getDocumentResults()) ? $documentCollectionCourseCompare->returnArrayResults() : [];
    $resultsCourseCompare = array_filter(
        $allResultsCourseCompare,
        function ($item) use ($queryCourseCompare) {
            return (isset($queryCourseCompare['compare_course[]']) && (in_array($item['contentID'], $queryCourseCompare['compare_course[]']))) || (!isset($queryCourseCompare['compare_course[]']));
        }
    );
    ?>
    <div id="coursecompare-results" role="main" data-t4-ajax-group="courseCompare" compare-min="<?php echo $configCourseCompare['min'] ?>" compare-max="<?php echo $configCourseCompare['max'] ?>">
        <?php if (!empty($resultsCourseCompare) && !empty($queryCourseCompare['compare_course[]']) && is_array($queryCourseCompare['compare_course[]']) && count($queryCourseCompare['compare_course[]']) <= $configCourseCompare['max']) : ?>
            <table class="responsive" data-t4-compare="table">
            <caption>Compared Courses</caption>
            <thead class="compare-heading">
                            <tr>
                            <?php foreach ($resultsCourseCompare as $item) : ?>
                                <th id="compare-course-<?php echo $item['contentID']; ?>">
                                    <a href='<?php echo $item['courseURL']; ?>'><?php echo $item['courseName']; ?></a>
                                </th>
                            <?php endforeach; ?>
                            </tr>
            </thead>

                <tbody>
   
                <?php $tabs = array(
                    'courseCode' => 'Course Code',
                    'courseDepartments' => 'Departments',
                    'courseType' => 'Course Type',
                    'courseLocation' => 'Course Location',
                    'courseCost' => 'Course Cost',
                    'courseDuration' => 'Course Duration',
                    'courseFaculties' => 'Course Faculties',
                    'courseOverview' => 'Course Overview',
                );
                ?>
                
                <?php foreach ($tabs as $element => $heading) : ?>
                    <?php
                    if (empty(array_filter(array_column($resultsCourseCompare, $element)))) {
                        continue;
                    }
                    ?>
                    <tr headers="compare-course-<?php echo $item['contentID']; ?>">
                        <?php foreach ($resultsCourseCompare as $item) : ?>
                        <td <?php echo (isset($item[$element]) && !empty($item[$element])) ? '' : 'class="na-data"'; ?>>
                            <p><strong><?php echo $heading; ?></strong></p>
                            <?php echo (isset($item[$element]) && !empty($item[$element])) ? $item[$element] : '<span>Data not available</span>'; ?>
                        </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?php
        else : ?>
            <?php if (!empty($resultsCourseCompare)) : ?>
                <p class='compare_error' data-t4-compare="error" <?php echo (isset($queryCourseCompare['compare_course[]']) && (!is_array($queryCourseCompare['compare_course[]']) || count($queryCourseCompare['compare_course[]']) > $configCourseCompare['max'])) ? 'style="display:block"' : '' ?> >The maximum number of courses you can compare at a time is <?php echo $configCourseCompare['max'] ?> and not less than <?php echo $configCourseCompare['min'] ?>.</p>
                <p>You haven't selected any programs. Please select some program to compare.</p>
                    <a href="<?php echo $configCourseCompare['course_search'] ?>" class="button  add-more-courses" type="button">Add More Programs</a>
            
            <?php else : ?>
                <p>You haven't saved any programs yet. Please click a program save button to compare programs here.</p>
                <a href="<?php echo $configCourseCompare['course_search'] ?>" class="button add-more-courses" type="button">Add More Programs</a>
            <?php endif;?>
        <?php endif;?>
    </div>




