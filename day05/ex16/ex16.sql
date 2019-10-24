SELECT COUNT(id_film) AS films FROM member_history WHERE (DATE_FORMAT(date, '%Y-%m-%d') BETWEEN '2006-10-30' AND '2007-27-07') OR DATE_FORMAT(date,'%m-%d') = '12-24';
