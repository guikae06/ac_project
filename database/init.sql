CREATE TABLE tracker_data (
  id SERIAL PRIMARY KEY,
  device_id VARCHAR(64) NOT NULL,
  temperature NUMERIC,
  humidity NUMERIC,
  timestamp TIMESTAMP DEFAULT now()
);

INSERT INTO tracker_data (device_id, temperature, humidity)
VALUES ('deviceA', 22.5, 45.3), ('deviceB', 21.2, 50.1);
