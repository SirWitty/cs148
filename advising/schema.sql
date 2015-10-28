CREATE TABLE IF NOT EXISTS tblAdvisors(
	pmkAdvisorId INT(9),
	fldFirstName INT(9),
	fldLastName VARCHAR(30),
	PRIMARY KEY (pmkAdvisorId)
);
CREATE TABLE IF NOT EXISTS tblStudents(
	pmkStudentId INT(9),
	fnkAdvisorId INT(9),
	fldFirstName VARCHAR(30),
	fldLastName VARCHAR(30),
	PRIMARY KEY (pmkStudentId),
        FOREIGN KEY (fnkAdvisorId) REFERENCES tblAdvisors(pmkAdvisorId)
);
CREATE TABLE IF NOT EXISTS tblFourYears(
	pmkFourYearId INT(9),
	fnkStudentId INT(9),
	fnkAdvisorId INT(9),
	fldMajor VARCHAR(9),
	fldMinor VARCHAR(9),
	PRIMARY KEY (pmkFourYearId),
	FOREIGN KEY (fnkStudentId) REFERENCES tblStudents(pmkStudentId),
	FOREIGN KEY (fnkAdvisorId) REFERENCES tblAdvisors(pmkAdvisorId)
);
CREATE TABLE IF NOT EXISTS tblCourses(
        pmkCourseId INT(9),
        fldNumber INT(3),
        fldCredits INT(1),
        fldDepartment VARCHAR(9),
        fldCatalogYear INT(4),
        PRIMARY KEY (pmkCourseId)
);
CREATE TABLE IF NOT EXISTS tblPlannedCourses(
	fnkFourYearId INT(9),
	fnkCourseId INT(9),
	fldSemester VARCHAR(3),
	fldYear INT(4),
	fldStatus VARCHAR(10),
	fldOrder INT(2),
	PRIMARY KEY (fnkFourYearId, fnkCourseId, fldSemester, fldYear),
	FOREIGN KEY (fnkFourYearId) REFERENCES tblFourYears(pmkFourYearId),
	FOREIGN KEY (fnkCourseId) REFERENCES tblCourses(pmkCourseId)
);
