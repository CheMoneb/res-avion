CREATE TABLE IF NOT EXISTS flights (
     id INT AUTO_INCREMENT PRIMARY KEY,
     departure_airport VARCHAR(255) NOT NULL,
    destination_airport VARCHAR(255) NOT NULL,
   departure_date DATE NOT NULL,
    arrival_date DATE NOT NULL,
     direct_flight BOOLEAN NOT NULL,
    status VARCHAR(255) NOT NULL
 ); 

 INSERT INTO flights (departure_airport, destination_airport, departure_date, arrival_date, direct_flight, status) VALUES
('JFK', 'LAX', '2023-08-01', '2023-08-01', 1, 'Scheduled'),
('LAX', 'JFK', '2023-08-02', '2023-08-02', 1, 'Scheduled'),
('ORD', 'DFW', '2023-08-01', '2023-08-01', 0, 'Scheduled'),
('DFW', 'ORD', '2023-08-02', '2023-08-02', 0, 'Scheduled'),
('ATL', 'MIA', '2023-08-01', '2023-08-01', 1, 'Scheduled'),
('MIA', 'ATL', '2023-08-02', '2023-08-02', 1, 'Scheduled'),
('LHR', 'CDG', '2023-08-01', '2023-08-01', 1, 'Scheduled'),
('CDG', 'LHR', '2023-08-02', '2023-08-02', 1, 'Scheduled'),
('DXB', 'SYD', '2023-08-01', '2023-08-02', 1, 'Scheduled'),
('SYD', 'DXB', '2023-08-03', '2023-08-04', 1, 'Scheduled');
