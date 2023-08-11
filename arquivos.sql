CREATE TABLE arquivos (
  id 		        int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nome          VARCHAR(255),
  path 		      varchar(100),
  data_upload 	date,
  id_razao 	    int(11),
   FOREIGN KEY (id_razao) REFERENCES razaosocial(id);
)