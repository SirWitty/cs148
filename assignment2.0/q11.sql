select distinct fnkCourseId, count(fnkCourseId) as 'Number of this CourseId' from tblSections group by fnkCourseId having count(fnkCourseId)>=50;
