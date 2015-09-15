select distinct fldBuilding, count(fldBuilding) as 'Number of Buildings' from tblSections group by fldBuilding;
