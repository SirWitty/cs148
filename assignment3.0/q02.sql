SELECT fldStart, fldStop, fldDays FROM tblSections INNER JOIN tblTeachers on fnkTeacherNetId = pmkNetId WHERE fldLastName = 'Snapp' AND fldFirstName='Robert Raymond' AND fldStart <> fldStop ORDER BY fldStart
