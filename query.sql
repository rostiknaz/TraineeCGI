1.Человек, который получает самую большую зарплату: 

SELECT id, full_name, email, salary FROM workers ORDER BY salary DESC LIMIT 1 

2.Человек, который получил самую большую зарплату за последние 3 месяца:

SELECT w.id, w.full_name, w.salary, w.email FROM workers as w 
Join salary_report as s ON w.id = s.worker_id
WHERE s.date_salary >= DATE_SUB(CURRENT_DATE, INTERVAL 3 MONTH) 
GROUP BY w.id 
ORDER BY w.salary DESC 
LIMIT 1

3.Второй человек который получает самую большую зарплату:

SELECT id, full_name, email, salary FROM workers ORDER BY salary DESC LIMIT 1,1

4.Посчитать сколько фирме нужно денег для выплат зарплат каждый месяц:

SELECT DATE_FORMAT(s.date_salary,'%M') as month, SUM(w.salary) as total_salary FROM workers as w 
Join salary_report as s ON w.id = s.worker_id 
GROUP BY month
