select fldCourseName, fldStart, fldStop FROM tblCourses INNER JOIN tblSections on fnkCourseId = pmkCourseId WHERE fnkTeacherNetId = 'jlhorton' AND fldType <> 'LAB' ORDER BY fldStart 
