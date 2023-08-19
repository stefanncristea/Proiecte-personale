DROP TABLE utilizatori;
/

CREATE TABLE utilizatori (
    id NUMBER NOT NULL,
    name varchar(255) NOT NULL,
    password varchar(255) NOT NULL
);
/

ALTER TABLE utilizatori
  ADD (
    CONSTRAINT utilizatori_pk PRIMARY KEY (id)
  );
/

CREATE SEQUENCE utilizatori_sequence;
CREATE OR REPLACE TRIGGER utilizatori_on_insert
  BEFORE INSERT ON utilizatori
  FOR EACH ROW
BEGIN
  SELECT utilizatori_sequence.nextval
  INTO :new.id
  FROM dual;
END;