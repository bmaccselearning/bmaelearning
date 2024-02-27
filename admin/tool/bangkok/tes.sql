CREATE VIEW view_users_job_with_names AS
SELECT
  CONCAT(d.DEPARTMENT_CODE, v.DIVISION_CODE, s.SECTION_CODE, j.JOB_CODE) AS ID,
  CONCAT(d.DEPARTMENT_Name, v.DIVISION_Name, s.SECTION_Name, j.JOB_Name) AS name
FROM
  view_users_job j 
LEFT JOIN
  view_users_department d ON j.DEPARTMENT_CODE = d.DEPARTMENT_CODE;
INNER JOIN
  view_users_division v ON j.DIVISION_CODE = v.DIVISION_CODE
INNER JOIN
  view_users_section s ON j.SECTION_CODE = s.SECTION_CODE

