USE db_partners;
CREATE TABLE table_partners (
    partner_name VARCHAR(30) NOT NULL,
    partner_type VARCHAR(20) NOT NULL,
    is_vip INT NOT NULL,
    city VARCHAR(20) NOT NULL,
    service_type VARCHAR(20) NOT NULL,
    base_address VARCHAR(50) NOT NULL,
    destination_address VARCHAR(50) NOT NULL,
    bandwidth VARCHAR(10),
    date_request_recieved VARCHAR(15) NOT NULL,
    traffic_source VARCHAR(30) NOT NULL,
    personal_manager VARCHAR(30) NOT NULL
);
