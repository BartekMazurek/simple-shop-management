--1) FIRST

DELIMITER //

CREATE PROCEDURE getOverallReport(IN dateFrom VARCHAR(11), IN dateTo VARCHAR(11))
BEGIN

    SELECT count(su.order_id) AS ordersCount, sum(su.order_value) AS ordersValue, su.name AS groupName FROM
        (SELECT o.client_id, cg.name , o.created_at, de.order_id, de.order_value FROM
            (SELECT od.order_id, sum(od.amount * p.price) AS order_value FROM order_details od
                JOIN products p
                ON od.product_id = p.id
                GROUP BY order_id) AS de
            JOIN orders o
            ON de.order_id = o.id
            JOIN clients c
            ON o.client_id = c.id
            JOIN client_groups cg
            ON c.group_id = cg.id
        WHERE (o.created_at BETWEEN concat(dateFrom, ' 00:00:00') AND concat(dateTo, ' 23:59:59'))
        ORDER BY o.created_at ASC) AS su
    GROUP BY su.name;

END//

--2) SECOND

DELIMITER //

CREATE PROCEDURE getClientsReport(IN dateFrom VARCHAR(11), IN dateTo VARCHAR(11), IN clientType INT)
BEGIN

    IF (clientType = 0) THEN
        SELECT ord.id, ord.name, count(ord.order_id) AS ordersCount, sum(ord.order_value) AS ordersValue FROM
            (SELECT c.id, c.name, c.group_id, o.created_at, od.order_id, sum(od.amount * p.price) AS order_value 
            FROM order_details od
                JOIN products p
                ON od.product_id = p.id
                JOIN orders o
                ON od.order_id = o.id
                JOIN clients c
                ON o.client_id = c.id
            GROUP BY order_id) AS ord
        WHERE (ord.created_at BETWEEN concat(dateFrom, ' 00:00:00') AND concat(dateTo, ' 23:59:59'))
        GROUP BY ord.id, ord.name;
    ELSE
        SELECT ord.id, ord.name, count(ord.order_id) AS ordersCount, sum(ord.order_value) AS ordersValue FROM
            (SELECT c.id, c.name, c.group_id, o.created_at, od.order_id, sum(od.amount * p.price) AS order_value 
            FROM order_details od
                JOIN products p
                ON od.product_id = p.id
                JOIN orders o
                ON od.order_id = o.id
                JOIN clients c
                ON o.client_id = c.id
            GROUP BY order_id) AS ord
        WHERE (ord.created_at BETWEEN concat(dateFrom, ' 00:00:00') AND concat(dateTo, ' 23:59:59')) AND ord.group_id IN(clientType)
        GROUP BY ord.id, ord.name;
    END IF;

END//

--3) THIRD

DELIMITER //

CREATE PROCEDURE getOrdersList(IN dateFrom VARCHAR(11), IN dateTo VARCHAR(11), IN clientType INT)
BEGIN

IF (clientType = 0) THEN
    SELECT o.id AS orderId, o.client_id AS clientId, c.name AS clientName, s.name AS statusName, date(o.modified_at) AS lastModified
    FROM orders o
        JOIN clients c
        ON o.client_id = c.id
        JOIN statuses s
        ON o.status_id = s.id
    WHERE (o.created_at BETWEEN concat(dateFrom, ' 00:00:00') AND concat(dateTo, ' 23:59:59'));
ELSE
    SELECT o.id AS orderId, o.client_id AS clientId, c.name AS clientName, s.name AS statusName, date(o.modified_at) AS lastModified
    FROM orders o
        JOIN clients c
        ON o.client_id = c.id
        JOIN statuses s
        ON o.status_id = s.id
    WHERE (o.created_at BETWEEN concat(dateFrom, ' 00:00:00') AND concat(dateTo, ' 23:59:59')) AND c.group_id IN(clientType);
END IF;

END//