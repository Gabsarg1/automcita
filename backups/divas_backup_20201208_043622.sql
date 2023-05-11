

CREATE TABLE `area` (
  `idarea` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_area` varchar(20) NOT NULL,
  PRIMARY KEY (`idarea`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

INSERT INTO area VALUES("1","0412-");
INSERT INTO area VALUES("2","0414-");
INSERT INTO area VALUES("3","0416-");
INSERT INTO area VALUES("4","0424-");
INSERT INTO area VALUES("5","0426-");
INSERT INTO area VALUES("6","0212-");



CREATE TABLE `cita` (
  `ci_cliente` varchar(20) NOT NULL,
  `ci_cosmetologa` varchar(20) NOT NULL,
  `idservicio` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `observacion` varchar(100) NOT NULL,
  `idstatus` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`ci_cliente`,`ci_cosmetologa`,`idservicio`,`fecha`,`hora`) USING BTREE,
  KEY `idservicio` (`idservicio`),
  KEY `fecha` (`fecha`),
  KEY `hora` (`hora`),
  KEY `idstatus` (`idstatus`),
  KEY `ci_cliente` (`ci_cliente`,`ci_cosmetologa`),
  KEY `ci_cosmetologa` (`ci_cosmetologa`),
  CONSTRAINT `cita_ibfk_2` FOREIGN KEY (`ci_cosmetologa`) REFERENCES `trabajo` (`ci_cosmetologa`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cita_ibfk_3` FOREIGN KEY (`ci_cliente`) REFERENCES `cliente` (`ci_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cita_ibfk_4` FOREIGN KEY (`idstatus`) REFERENCES `status` (`idatatus`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO cita VALUES("V-25702124","V-19274216","14","2020-12-08","12:00:00","","1");
INSERT INTO cita VALUES("V-26296674","V-19274216","18","2020-12-07","12:00:00","","4");
INSERT INTO cita VALUES("V-28822543","V-4444444","9","2020-12-05","10:30:00","","1");
INSERT INTO cita VALUES("V-3367559","V-2222222","7","2020-12-19","13:00:00","","1");



CREATE TABLE `ciudades` (
  `id_ciudad` int(11) NOT NULL AUTO_INCREMENT,
  `id_estado` int(11) NOT NULL,
  `ciudad` varchar(200) NOT NULL,
  PRIMARY KEY (`id_ciudad`) USING BTREE,
  KEY `id_estado` (`id_estado`),
  CONSTRAINT `ciudades_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id_estado`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=523 DEFAULT CHARSET=utf8;

INSERT INTO ciudades VALUES("1","1","Maroa");
INSERT INTO ciudades VALUES("2","1","Puerto Ayacucho");
INSERT INTO ciudades VALUES("3","1","San Fernando de Atabapo");
INSERT INTO ciudades VALUES("4","2","Anaco");
INSERT INTO ciudades VALUES("5","2","Aragua de Barcelona");
INSERT INTO ciudades VALUES("6","2","Barcelona");
INSERT INTO ciudades VALUES("7","2","Boca de Uchire");
INSERT INTO ciudades VALUES("8","2","Cantaura");
INSERT INTO ciudades VALUES("9","2","Clarines");
INSERT INTO ciudades VALUES("10","2","El Chaparro");
INSERT INTO ciudades VALUES("11","2","El Pao Anzoátegui");
INSERT INTO ciudades VALUES("12","2","El Tigre");
INSERT INTO ciudades VALUES("13","2","El Tigrito");
INSERT INTO ciudades VALUES("14","2","Guanape");
INSERT INTO ciudades VALUES("15","2","Guanta");
INSERT INTO ciudades VALUES("16","2","Lechería");
INSERT INTO ciudades VALUES("17","2","Onoto");
INSERT INTO ciudades VALUES("18","2","Pariaguán");
INSERT INTO ciudades VALUES("19","2","Píritu");
INSERT INTO ciudades VALUES("20","2","Puerto La Cruz");
INSERT INTO ciudades VALUES("21","2","Puerto Píritu");
INSERT INTO ciudades VALUES("22","2","Sabana de Uchire");
INSERT INTO ciudades VALUES("23","2","San Mateo Anzoátegui");
INSERT INTO ciudades VALUES("24","2","San Pablo Anzoátegui");
INSERT INTO ciudades VALUES("25","2","San Tomé");
INSERT INTO ciudades VALUES("26","2","Santa Ana de Anzoátegui");
INSERT INTO ciudades VALUES("27","2","Santa Fe Anzoátegui");
INSERT INTO ciudades VALUES("28","2","Santa Rosa");
INSERT INTO ciudades VALUES("29","2","Soledad");
INSERT INTO ciudades VALUES("30","2","Urica");
INSERT INTO ciudades VALUES("31","2","Valle de Guanape");
INSERT INTO ciudades VALUES("43","3","Achaguas");
INSERT INTO ciudades VALUES("44","3","Biruaca");
INSERT INTO ciudades VALUES("45","3","Bruzual");
INSERT INTO ciudades VALUES("46","3","El Amparo");
INSERT INTO ciudades VALUES("47","3","El Nula");
INSERT INTO ciudades VALUES("48","3","Elorza");
INSERT INTO ciudades VALUES("49","3","Guasdualito");
INSERT INTO ciudades VALUES("50","3","Mantecal");
INSERT INTO ciudades VALUES("51","3","Puerto Páez");
INSERT INTO ciudades VALUES("52","3","San Fernando de Apure");
INSERT INTO ciudades VALUES("53","3","San Juan de Payara");
INSERT INTO ciudades VALUES("54","4","Barbacoas");
INSERT INTO ciudades VALUES("55","4","Cagua");
INSERT INTO ciudades VALUES("56","4","Camatagua");
INSERT INTO ciudades VALUES("58","4","Choroní");
INSERT INTO ciudades VALUES("59","4","Colonia Tovar");
INSERT INTO ciudades VALUES("60","4","El Consejo");
INSERT INTO ciudades VALUES("61","4","La Victoria");
INSERT INTO ciudades VALUES("62","4","Las Tejerías");
INSERT INTO ciudades VALUES("63","4","Magdaleno");
INSERT INTO ciudades VALUES("64","4","Maracay");
INSERT INTO ciudades VALUES("65","4","Ocumare de La Costa");
INSERT INTO ciudades VALUES("66","4","Palo Negro");
INSERT INTO ciudades VALUES("67","4","San Casimiro");
INSERT INTO ciudades VALUES("68","4","San Mateo");
INSERT INTO ciudades VALUES("69","4","San Sebastián");
INSERT INTO ciudades VALUES("70","4","Santa Cruz de Aragua");
INSERT INTO ciudades VALUES("71","4","Tocorón");
INSERT INTO ciudades VALUES("72","4","Turmero");
INSERT INTO ciudades VALUES("73","4","Villa de Cura");
INSERT INTO ciudades VALUES("74","4","Zuata");
INSERT INTO ciudades VALUES("75","5","Barinas");
INSERT INTO ciudades VALUES("76","5","Barinitas");
INSERT INTO ciudades VALUES("77","5","Barrancas");
INSERT INTO ciudades VALUES("78","5","Calderas");
INSERT INTO ciudades VALUES("79","5","Capitanejo");
INSERT INTO ciudades VALUES("80","5","Ciudad Bolivia");
INSERT INTO ciudades VALUES("81","5","El Cantón");
INSERT INTO ciudades VALUES("82","5","Las Veguitas");
INSERT INTO ciudades VALUES("83","5","Libertad de Barinas");
INSERT INTO ciudades VALUES("84","5","Sabaneta");
INSERT INTO ciudades VALUES("85","5","Santa Bárbara de Barinas");
INSERT INTO ciudades VALUES("86","5","Socopó");
INSERT INTO ciudades VALUES("87","6","Caicara del Orinoco");
INSERT INTO ciudades VALUES("88","6","Canaima");
INSERT INTO ciudades VALUES("89","6","Ciudad Bolívar");
INSERT INTO ciudades VALUES("90","6","Ciudad Piar");
INSERT INTO ciudades VALUES("91","6","El Callao");
INSERT INTO ciudades VALUES("92","6","El Dorado");
INSERT INTO ciudades VALUES("93","6","El Manteco");
INSERT INTO ciudades VALUES("94","6","El Palmar");
INSERT INTO ciudades VALUES("95","6","El Pao");
INSERT INTO ciudades VALUES("96","6","Guasipati");
INSERT INTO ciudades VALUES("97","6","Guri");
INSERT INTO ciudades VALUES("98","6","La Paragua");
INSERT INTO ciudades VALUES("99","6","Matanzas");
INSERT INTO ciudades VALUES("100","6","Puerto Ordaz");
INSERT INTO ciudades VALUES("101","6","San Félix");
INSERT INTO ciudades VALUES("102","6","Santa Elena de Uairén");
INSERT INTO ciudades VALUES("103","6","Tumeremo");
INSERT INTO ciudades VALUES("104","6","Unare");
INSERT INTO ciudades VALUES("105","6","Upata");
INSERT INTO ciudades VALUES("106","7","Bejuma");
INSERT INTO ciudades VALUES("107","7","Belén");
INSERT INTO ciudades VALUES("108","7","Campo de Carabobo");
INSERT INTO ciudades VALUES("109","7","Canoabo");
INSERT INTO ciudades VALUES("110","7","Central Tacarigua");
INSERT INTO ciudades VALUES("111","7","Chirgua");
INSERT INTO ciudades VALUES("112","7","Ciudad Alianza");
INSERT INTO ciudades VALUES("113","7","El Palito");
INSERT INTO ciudades VALUES("114","7","Guacara");
INSERT INTO ciudades VALUES("115","7","Guigue");
INSERT INTO ciudades VALUES("116","7","Las Trincheras");
INSERT INTO ciudades VALUES("117","7","Los Guayos");
INSERT INTO ciudades VALUES("118","7","Mariara");
INSERT INTO ciudades VALUES("119","7","Miranda");
INSERT INTO ciudades VALUES("120","7","Montalbán");
INSERT INTO ciudades VALUES("121","7","Morón");
INSERT INTO ciudades VALUES("122","7","Naguanagua");
INSERT INTO ciudades VALUES("123","7","Puerto Cabello");
INSERT INTO ciudades VALUES("124","7","San Joaquín");
INSERT INTO ciudades VALUES("125","7","Tocuyito");
INSERT INTO ciudades VALUES("126","7","Urama");
INSERT INTO ciudades VALUES("127","7","Valencia");
INSERT INTO ciudades VALUES("128","7","Vigirimita");
INSERT INTO ciudades VALUES("129","8","Aguirre");
INSERT INTO ciudades VALUES("130","8","Apartaderos Cojedes");
INSERT INTO ciudades VALUES("131","8","Arismendi");
INSERT INTO ciudades VALUES("132","8","Camuriquito");
INSERT INTO ciudades VALUES("133","8","El Baúl");
INSERT INTO ciudades VALUES("134","8","El Limón");
INSERT INTO ciudades VALUES("135","8","El Pao Cojedes");
INSERT INTO ciudades VALUES("136","8","El Socorro");
INSERT INTO ciudades VALUES("137","8","La Aguadita");
INSERT INTO ciudades VALUES("138","8","Las Vegas");
INSERT INTO ciudades VALUES("139","8","Libertad de Cojedes");
INSERT INTO ciudades VALUES("140","8","Mapuey");
INSERT INTO ciudades VALUES("141","8","Piñedo");
INSERT INTO ciudades VALUES("142","8","Samancito");
INSERT INTO ciudades VALUES("143","8","San Carlos");
INSERT INTO ciudades VALUES("144","8","Sucre");
INSERT INTO ciudades VALUES("145","8","Tinaco");
INSERT INTO ciudades VALUES("146","8","Tinaquillo");
INSERT INTO ciudades VALUES("147","8","Vallecito");
INSERT INTO ciudades VALUES("148","9","Tucupita");
INSERT INTO ciudades VALUES("149","24","Caracas");
INSERT INTO ciudades VALUES("150","24","El Junquito");
INSERT INTO ciudades VALUES("151","10","Adícora");
INSERT INTO ciudades VALUES("152","10","Boca de Aroa");
INSERT INTO ciudades VALUES("153","10","Cabure");
INSERT INTO ciudades VALUES("154","10","Capadare");
INSERT INTO ciudades VALUES("155","10","Capatárida");
INSERT INTO ciudades VALUES("156","10","Chichiriviche");
INSERT INTO ciudades VALUES("157","10","Churuguara");
INSERT INTO ciudades VALUES("158","10","Coro");
INSERT INTO ciudades VALUES("159","10","Cumarebo");
INSERT INTO ciudades VALUES("160","10","Dabajuro");
INSERT INTO ciudades VALUES("161","10","Judibana");
INSERT INTO ciudades VALUES("162","10","La Cruz de Taratara");
INSERT INTO ciudades VALUES("163","10","La Vela de Coro");
INSERT INTO ciudades VALUES("164","10","Los Taques");
INSERT INTO ciudades VALUES("165","10","Maparari");
INSERT INTO ciudades VALUES("166","10","Mene de Mauroa");
INSERT INTO ciudades VALUES("167","10","Mirimire");
INSERT INTO ciudades VALUES("168","10","Pedregal");
INSERT INTO ciudades VALUES("169","10","Píritu Falcón");
INSERT INTO ciudades VALUES("170","10","Pueblo Nuevo Falcón");
INSERT INTO ciudades VALUES("171","10","Puerto Cumarebo");
INSERT INTO ciudades VALUES("172","10","Punta Cardón");
INSERT INTO ciudades VALUES("173","10","Punto Fijo");
INSERT INTO ciudades VALUES("174","10","San Juan de Los Cayos");
INSERT INTO ciudades VALUES("175","10","San Luis");
INSERT INTO ciudades VALUES("176","10","Santa Ana Falcón");
INSERT INTO ciudades VALUES("177","10","Santa Cruz De Bucaral");
INSERT INTO ciudades VALUES("178","10","Tocopero");
INSERT INTO ciudades VALUES("179","10","Tocuyo de La Costa");
INSERT INTO ciudades VALUES("180","10","Tucacas");
INSERT INTO ciudades VALUES("181","10","Yaracal");
INSERT INTO ciudades VALUES("182","11","Altagracia de Orituco");
INSERT INTO ciudades VALUES("183","11","Cabruta");
INSERT INTO ciudades VALUES("184","11","Calabozo");
INSERT INTO ciudades VALUES("185","11","Camaguán");
INSERT INTO ciudades VALUES("196","11","Chaguaramas Guárico");
INSERT INTO ciudades VALUES("197","11","El Socorro");
INSERT INTO ciudades VALUES("198","11","El Sombrero");
INSERT INTO ciudades VALUES("199","11","Las Mercedes de Los Llanos");
INSERT INTO ciudades VALUES("200","11","Lezama");
INSERT INTO ciudades VALUES("201","11","Onoto");
INSERT INTO ciudades VALUES("202","11","Ortíz");
INSERT INTO ciudades VALUES("203","11","San José de Guaribe");
INSERT INTO ciudades VALUES("204","11","San Juan de Los Morros");
INSERT INTO ciudades VALUES("205","11","San Rafael de Laya");
INSERT INTO ciudades VALUES("206","11","Santa María de Ipire");
INSERT INTO ciudades VALUES("207","11","Tucupido");
INSERT INTO ciudades VALUES("208","11","Valle de La Pascua");
INSERT INTO ciudades VALUES("209","11","Zaraza");
INSERT INTO ciudades VALUES("210","12","Aguada Grande");
INSERT INTO ciudades VALUES("211","12","Atarigua");
INSERT INTO ciudades VALUES("212","12","Barquisimeto");
INSERT INTO ciudades VALUES("213","12","Bobare");
INSERT INTO ciudades VALUES("214","12","Cabudare");
INSERT INTO ciudades VALUES("215","12","Carora");
INSERT INTO ciudades VALUES("216","12","Cubiro");
INSERT INTO ciudades VALUES("217","12","Cují");
INSERT INTO ciudades VALUES("218","12","Duaca");
INSERT INTO ciudades VALUES("219","12","El Manzano");
INSERT INTO ciudades VALUES("220","12","El Tocuyo");
INSERT INTO ciudades VALUES("221","12","Guaríco");
INSERT INTO ciudades VALUES("222","12","Humocaro Alto");
INSERT INTO ciudades VALUES("223","12","Humocaro Bajo");
INSERT INTO ciudades VALUES("224","12","La Miel");
INSERT INTO ciudades VALUES("225","12","Moroturo");
INSERT INTO ciudades VALUES("226","12","Quíbor");
INSERT INTO ciudades VALUES("227","12","Río Claro");
INSERT INTO ciudades VALUES("228","12","Sanare");
INSERT INTO ciudades VALUES("229","12","Santa Inés");
INSERT INTO ciudades VALUES("230","12","Sarare");
INSERT INTO ciudades VALUES("231","12","Siquisique");
INSERT INTO ciudades VALUES("232","12","Tintorero");
INSERT INTO ciudades VALUES("233","13","Apartaderos Mérida");
INSERT INTO ciudades VALUES("234","13","Arapuey");
INSERT INTO ciudades VALUES("235","13","Bailadores");
INSERT INTO ciudades VALUES("236","13","Caja Seca");
INSERT INTO ciudades VALUES("237","13","Canaguá");
INSERT INTO ciudades VALUES("238","13","Chachopo");
INSERT INTO ciudades VALUES("239","13","Chiguara");
INSERT INTO ciudades VALUES("240","13","Ejido");
INSERT INTO ciudades VALUES("241","13","El Vigía");
INSERT INTO ciudades VALUES("242","13","La Azulita");
INSERT INTO ciudades VALUES("243","13","La Playa");
INSERT INTO ciudades VALUES("244","13","Lagunillas Mérida");
INSERT INTO ciudades VALUES("245","13","Mérida");
INSERT INTO ciudades VALUES("246","13","Mesa de Bolívar");
INSERT INTO ciudades VALUES("247","13","Mucuchíes");
INSERT INTO ciudades VALUES("248","13","Mucujepe");
INSERT INTO ciudades VALUES("249","13","Mucuruba");
INSERT INTO ciudades VALUES("250","13","Nueva Bolivia");
INSERT INTO ciudades VALUES("251","13","Palmarito");
INSERT INTO ciudades VALUES("252","13","Pueblo Llano");
INSERT INTO ciudades VALUES("253","13","Santa Cruz de Mora");
INSERT INTO ciudades VALUES("254","13","Santa Elena de Arenales");
INSERT INTO ciudades VALUES("255","13","Santo Domingo");
INSERT INTO ciudades VALUES("256","13","Tabáy");
INSERT INTO ciudades VALUES("257","13","Timotes");
INSERT INTO ciudades VALUES("258","13","Torondoy");
INSERT INTO ciudades VALUES("259","13","Tovar");
INSERT INTO ciudades VALUES("260","13","Tucani");
INSERT INTO ciudades VALUES("261","13","Zea");
INSERT INTO ciudades VALUES("262","14","Araguita");
INSERT INTO ciudades VALUES("263","14","Carrizal");
INSERT INTO ciudades VALUES("264","14","Caucagua");
INSERT INTO ciudades VALUES("265","14","Chaguaramas Miranda");
INSERT INTO ciudades VALUES("266","14","Charallave");
INSERT INTO ciudades VALUES("267","14","Chirimena");
INSERT INTO ciudades VALUES("268","14","Chuspa");
INSERT INTO ciudades VALUES("269","14","Cúa");
INSERT INTO ciudades VALUES("270","14","Cupira");
INSERT INTO ciudades VALUES("271","14","Curiepe");
INSERT INTO ciudades VALUES("272","14","El Guapo");
INSERT INTO ciudades VALUES("273","14","El Jarillo");
INSERT INTO ciudades VALUES("274","14","Filas de Mariche");
INSERT INTO ciudades VALUES("275","14","Guarenas");
INSERT INTO ciudades VALUES("276","14","Guatire");
INSERT INTO ciudades VALUES("277","14","Higuerote");
INSERT INTO ciudades VALUES("278","14","Los Anaucos");
INSERT INTO ciudades VALUES("279","14","Los Teques");
INSERT INTO ciudades VALUES("280","14","Ocumare del Tuy");
INSERT INTO ciudades VALUES("281","14","Panaquire");
INSERT INTO ciudades VALUES("282","14","Paracotos");
INSERT INTO ciudades VALUES("283","14","Río Chico");
INSERT INTO ciudades VALUES("284","14","San Antonio de Los Altos");
INSERT INTO ciudades VALUES("285","14","San Diego de Los Altos");
INSERT INTO ciudades VALUES("286","14","San Fernando del Guapo");
INSERT INTO ciudades VALUES("287","14","San Francisco de Yare");
INSERT INTO ciudades VALUES("288","14","San José de Los Altos");
INSERT INTO ciudades VALUES("289","14","San José de Río Chico");
INSERT INTO ciudades VALUES("290","14","San Pedro de Los Altos");
INSERT INTO ciudades VALUES("291","14","Santa Lucía");
INSERT INTO ciudades VALUES("292","14","Santa Teresa");
INSERT INTO ciudades VALUES("293","14","Tacarigua de La Laguna");
INSERT INTO ciudades VALUES("294","14","Tacarigua de Mamporal");
INSERT INTO ciudades VALUES("295","14","Tácata");
INSERT INTO ciudades VALUES("296","14","Turumo");
INSERT INTO ciudades VALUES("297","15","Aguasay");
INSERT INTO ciudades VALUES("298","15","Aragua de Maturín");
INSERT INTO ciudades VALUES("299","15","Barrancas del Orinoco");
INSERT INTO ciudades VALUES("300","15","Caicara de Maturín");
INSERT INTO ciudades VALUES("301","15","Caripe");
INSERT INTO ciudades VALUES("302","15","Caripito");
INSERT INTO ciudades VALUES("303","15","Chaguaramal");
INSERT INTO ciudades VALUES("305","15","Chaguaramas Monagas");
INSERT INTO ciudades VALUES("307","15","El Furrial");
INSERT INTO ciudades VALUES("308","15","El Tejero");
INSERT INTO ciudades VALUES("309","15","Jusepín");
INSERT INTO ciudades VALUES("310","15","La Toscana");
INSERT INTO ciudades VALUES("311","15","Maturín");
INSERT INTO ciudades VALUES("312","15","Miraflores");
INSERT INTO ciudades VALUES("313","15","Punta de Mata");
INSERT INTO ciudades VALUES("314","15","Quiriquire");
INSERT INTO ciudades VALUES("315","15","San Antonio de Maturín");
INSERT INTO ciudades VALUES("316","15","San Vicente Monagas");
INSERT INTO ciudades VALUES("317","15","Santa Bárbara");
INSERT INTO ciudades VALUES("318","15","Temblador");
INSERT INTO ciudades VALUES("319","15","Teresen");
INSERT INTO ciudades VALUES("320","15","Uracoa");
INSERT INTO ciudades VALUES("321","16","Altagracia");
INSERT INTO ciudades VALUES("322","16","Boca de Pozo");
INSERT INTO ciudades VALUES("323","16","Boca de Río");
INSERT INTO ciudades VALUES("324","16","El Espinal");
INSERT INTO ciudades VALUES("325","16","El Valle del Espíritu Santo");
INSERT INTO ciudades VALUES("326","16","El Yaque");
INSERT INTO ciudades VALUES("327","16","Juangriego");
INSERT INTO ciudades VALUES("328","16","La Asunción");
INSERT INTO ciudades VALUES("329","16","La Guardia");
INSERT INTO ciudades VALUES("330","16","Pampatar");
INSERT INTO ciudades VALUES("331","16","Porlamar");
INSERT INTO ciudades VALUES("332","16","Puerto Fermín");
INSERT INTO ciudades VALUES("333","16","Punta de Piedras");
INSERT INTO ciudades VALUES("334","16","San Francisco de Macanao");
INSERT INTO ciudades VALUES("335","16","San Juan Bautista");
INSERT INTO ciudades VALUES("336","16","San Pedro de Coche");
INSERT INTO ciudades VALUES("337","16","Santa Ana de Nueva Esparta");
INSERT INTO ciudades VALUES("338","16","Villa Rosa");
INSERT INTO ciudades VALUES("339","17","Acarigua");
INSERT INTO ciudades VALUES("340","17","Agua Blanca");
INSERT INTO ciudades VALUES("341","17","Araure");
INSERT INTO ciudades VALUES("342","17","Biscucuy");
INSERT INTO ciudades VALUES("343","17","Boconoito");
INSERT INTO ciudades VALUES("344","17","Campo Elías");
INSERT INTO ciudades VALUES("345","17","Chabasquén");
INSERT INTO ciudades VALUES("346","17","Guanare");
INSERT INTO ciudades VALUES("347","17","Guanarito");
INSERT INTO ciudades VALUES("348","17","La Aparición");
INSERT INTO ciudades VALUES("349","17","La Misión");
INSERT INTO ciudades VALUES("350","17","Mesa de Cavacas");
INSERT INTO ciudades VALUES("351","17","Ospino");
INSERT INTO ciudades VALUES("352","17","Papelón");
INSERT INTO ciudades VALUES("353","17","Payara");
INSERT INTO ciudades VALUES("354","17","Pimpinela");
INSERT INTO ciudades VALUES("355","17","Píritu de Portuguesa");
INSERT INTO ciudades VALUES("356","17","San Rafael de Onoto");
INSERT INTO ciudades VALUES("357","17","Santa Rosalía");
INSERT INTO ciudades VALUES("358","17","Turén");
INSERT INTO ciudades VALUES("359","18","Altos de Sucre");
INSERT INTO ciudades VALUES("360","18","Araya");
INSERT INTO ciudades VALUES("361","18","Cariaco");
INSERT INTO ciudades VALUES("362","18","Carúpano");
INSERT INTO ciudades VALUES("363","18","Casanay");
INSERT INTO ciudades VALUES("364","18","Cumaná");
INSERT INTO ciudades VALUES("365","18","Cumanacoa");
INSERT INTO ciudades VALUES("366","18","El Morro Puerto Santo");
INSERT INTO ciudades VALUES("367","18","El Pilar");
INSERT INTO ciudades VALUES("368","18","El Poblado");
INSERT INTO ciudades VALUES("369","18","Guaca");
INSERT INTO ciudades VALUES("370","18","Guiria");
INSERT INTO ciudades VALUES("371","18","Irapa");
INSERT INTO ciudades VALUES("372","18","Manicuare");
INSERT INTO ciudades VALUES("373","18","Mariguitar");
INSERT INTO ciudades VALUES("374","18","Río Caribe");
INSERT INTO ciudades VALUES("375","18","San Antonio del Golfo");
INSERT INTO ciudades VALUES("376","18","San José de Aerocuar");
INSERT INTO ciudades VALUES("377","18","San Vicente de Sucre");
INSERT INTO ciudades VALUES("378","18","Santa Fe de Sucre");
INSERT INTO ciudades VALUES("379","18","Tunapuy");
INSERT INTO ciudades VALUES("380","18","Yaguaraparo");
INSERT INTO ciudades VALUES("381","18","Yoco");
INSERT INTO ciudades VALUES("382","19","Abejales");
INSERT INTO ciudades VALUES("383","19","Borota");
INSERT INTO ciudades VALUES("384","19","Bramon");
INSERT INTO ciudades VALUES("385","19","Capacho");
INSERT INTO ciudades VALUES("386","19","Colón");
INSERT INTO ciudades VALUES("387","19","Coloncito");
INSERT INTO ciudades VALUES("388","19","Cordero");
INSERT INTO ciudades VALUES("389","19","El Cobre");
INSERT INTO ciudades VALUES("390","19","El Pinal");
INSERT INTO ciudades VALUES("391","19","Independencia");
INSERT INTO ciudades VALUES("392","19","La Fría");
INSERT INTO ciudades VALUES("393","19","La Grita");
INSERT INTO ciudades VALUES("394","19","La Pedrera");
INSERT INTO ciudades VALUES("395","19","La Tendida");
INSERT INTO ciudades VALUES("396","19","Las Delicias");
INSERT INTO ciudades VALUES("397","19","Las Hernández");
INSERT INTO ciudades VALUES("398","19","Lobatera");
INSERT INTO ciudades VALUES("399","19","Michelena");
INSERT INTO ciudades VALUES("400","19","Palmira");
INSERT INTO ciudades VALUES("401","19","Pregonero");
INSERT INTO ciudades VALUES("402","19","Queniquea");
INSERT INTO ciudades VALUES("403","19","Rubio");
INSERT INTO ciudades VALUES("404","19","San Antonio del Tachira");
INSERT INTO ciudades VALUES("405","19","San Cristobal");
INSERT INTO ciudades VALUES("406","19","San José de Bolívar");
INSERT INTO ciudades VALUES("407","19","San Josecito");
INSERT INTO ciudades VALUES("408","19","San Pedro del Río");
INSERT INTO ciudades VALUES("409","19","Santa Ana Táchira");
INSERT INTO ciudades VALUES("410","19","Seboruco");
INSERT INTO ciudades VALUES("411","19","Táriba");
INSERT INTO ciudades VALUES("412","19","Umuquena");
INSERT INTO ciudades VALUES("413","19","Ureña");
INSERT INTO ciudades VALUES("414","20","Batatal");
INSERT INTO ciudades VALUES("415","20","Betijoque");
INSERT INTO ciudades VALUES("416","20","Boconó");
INSERT INTO ciudades VALUES("417","20","Carache");
INSERT INTO ciudades VALUES("418","20","Chejende");
INSERT INTO ciudades VALUES("419","20","Cuicas");
INSERT INTO ciudades VALUES("420","20","El Dividive");
INSERT INTO ciudades VALUES("421","20","El Jaguito");
INSERT INTO ciudades VALUES("422","20","Escuque");
INSERT INTO ciudades VALUES("423","20","Isnotú");
INSERT INTO ciudades VALUES("424","20","Jajó");
INSERT INTO ciudades VALUES("425","20","La Ceiba");
INSERT INTO ciudades VALUES("426","20","La Concepción de Trujllo");
INSERT INTO ciudades VALUES("427","20","La Mesa de Esnujaque");
INSERT INTO ciudades VALUES("428","20","La Puerta");
INSERT INTO ciudades VALUES("429","20","La Quebrada");
INSERT INTO ciudades VALUES("430","20","Mendoza Fría");
INSERT INTO ciudades VALUES("431","20","Meseta de Chimpire");
INSERT INTO ciudades VALUES("432","20","Monay");
INSERT INTO ciudades VALUES("433","20","Motatán");
INSERT INTO ciudades VALUES("434","20","Pampán");
INSERT INTO ciudades VALUES("435","20","Pampanito");
INSERT INTO ciudades VALUES("436","20","Sabana de Mendoza");
INSERT INTO ciudades VALUES("437","20","San Lázaro");
INSERT INTO ciudades VALUES("438","20","Santa Ana de Trujillo");
INSERT INTO ciudades VALUES("439","20","Tostós");
INSERT INTO ciudades VALUES("440","20","Trujillo");
INSERT INTO ciudades VALUES("441","20","Valera");
INSERT INTO ciudades VALUES("442","21","Carayaca");
INSERT INTO ciudades VALUES("443","21","Litoral");
INSERT INTO ciudades VALUES("445","22","Aroa");
INSERT INTO ciudades VALUES("446","22","Boraure");
INSERT INTO ciudades VALUES("447","22","Campo Elías de Yaracuy");
INSERT INTO ciudades VALUES("448","22","Chivacoa");
INSERT INTO ciudades VALUES("449","22","Cocorote");
INSERT INTO ciudades VALUES("450","22","Farriar");
INSERT INTO ciudades VALUES("451","22","Guama");
INSERT INTO ciudades VALUES("452","22","Marín");
INSERT INTO ciudades VALUES("453","22","Nirgua");
INSERT INTO ciudades VALUES("454","22","Sabana de Parra");
INSERT INTO ciudades VALUES("455","22","Salom");
INSERT INTO ciudades VALUES("456","22","San Felipe");
INSERT INTO ciudades VALUES("457","22","San Pablo de Yaracuy");
INSERT INTO ciudades VALUES("458","22","Urachiche");
INSERT INTO ciudades VALUES("459","22","Yaritagua");
INSERT INTO ciudades VALUES("460","22","Yumare");
INSERT INTO ciudades VALUES("461","23","Bachaquero");
INSERT INTO ciudades VALUES("462","23","Bobures");
INSERT INTO ciudades VALUES("463","23","Cabimas");
INSERT INTO ciudades VALUES("464","23","Campo Concepción");
INSERT INTO ciudades VALUES("465","23","Campo Mara");
INSERT INTO ciudades VALUES("466","23","Campo Rojo");
INSERT INTO ciudades VALUES("467","23","Carrasquero");
INSERT INTO ciudades VALUES("468","23","Casigua");
INSERT INTO ciudades VALUES("469","23","Chiquinquirá");
INSERT INTO ciudades VALUES("470","23","Ciudad Ojeda");
INSERT INTO ciudades VALUES("471","23","El Batey");
INSERT INTO ciudades VALUES("472","23","El Carmelo");
INSERT INTO ciudades VALUES("473","23","El Chivo");
INSERT INTO ciudades VALUES("474","23","El Guayabo");
INSERT INTO ciudades VALUES("475","23","El Mene");
INSERT INTO ciudades VALUES("476","23","El Venado");
INSERT INTO ciudades VALUES("477","23","Encontrados");
INSERT INTO ciudades VALUES("478","23","Gibraltar");
INSERT INTO ciudades VALUES("479","23","Isla de Toas");
INSERT INTO ciudades VALUES("480","23","La Concepción del Zulia");
INSERT INTO ciudades VALUES("481","23","La Paz");
INSERT INTO ciudades VALUES("482","23","La Sierrita");
INSERT INTO ciudades VALUES("483","23","Lagunillas del Zulia");
INSERT INTO ciudades VALUES("484","23","Las Piedras de Perijá");
INSERT INTO ciudades VALUES("485","23","Los Cortijos");
INSERT INTO ciudades VALUES("486","23","Machiques");
INSERT INTO ciudades VALUES("487","23","Maracaibo");
INSERT INTO ciudades VALUES("488","23","Mene Grande");
INSERT INTO ciudades VALUES("489","23","Palmarejo");
INSERT INTO ciudades VALUES("490","23","Paraguaipoa");
INSERT INTO ciudades VALUES("491","23","Potrerito");
INSERT INTO ciudades VALUES("492","23","Pueblo Nuevo del Zulia");
INSERT INTO ciudades VALUES("493","23","Puertos de Altagracia");
INSERT INTO ciudades VALUES("494","23","Punta Gorda");
INSERT INTO ciudades VALUES("495","23","Sabaneta de Palma");
INSERT INTO ciudades VALUES("496","23","San Francisco");
INSERT INTO ciudades VALUES("497","23","San José de Perijá");
INSERT INTO ciudades VALUES("498","23","San Rafael del Moján");
INSERT INTO ciudades VALUES("499","23","San Timoteo");
INSERT INTO ciudades VALUES("500","23","Santa Bárbara Del Zulia");
INSERT INTO ciudades VALUES("501","23","Santa Cruz de Mara");
INSERT INTO ciudades VALUES("502","23","Santa Cruz del Zulia");
INSERT INTO ciudades VALUES("503","23","Santa Rita");
INSERT INTO ciudades VALUES("504","23","Sinamaica");
INSERT INTO ciudades VALUES("505","23","Tamare");
INSERT INTO ciudades VALUES("506","23","Tía Juana");
INSERT INTO ciudades VALUES("507","23","Villa del Rosario");
INSERT INTO ciudades VALUES("508","21","La Guaira");
INSERT INTO ciudades VALUES("509","21","Catia La Mar");
INSERT INTO ciudades VALUES("510","21","Macuto");
INSERT INTO ciudades VALUES("511","21","Naiguatá");



CREATE TABLE `cliente` (
  `ci_cliente` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `codgenero` int(11) NOT NULL,
  `fechaingreso` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estatus` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`ci_cliente`) USING BTREE,
  KEY `codgenero` (`codgenero`),
  CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`codgenero`) REFERENCES `genero` (`codgenero`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO cliente VALUES("V-1111111","Andreinapp","Pérez","2000-06-15","1","2020-12-07 18:26:29","1");
INSERT INTO cliente VALUES("V-1234565","Alfredo","Aguila","2020-12-01","2","2020-12-03 10:34:45","1");
INSERT INTO cliente VALUES("V-1768686","Catherin Michelle","Diamond Rodriguez","2001-05-29","1","2020-12-03 15:59:59","1");
INSERT INTO cliente VALUES("V-2222222","Angelah","Mesa","2020-12-01","1","2020-12-03 14:49:00","1");
INSERT INTO cliente VALUES("V-22852963","Vanessa","La Rosa","1985-02-27","1","2020-12-04 09:42:37","1");
INSERT INTO cliente VALUES("V-2287970","Anaisa","Pérez","2000-10-12","1","2020-12-03 10:28:31","1");
INSERT INTO cliente VALUES("V-24899571","Valeria","Ostoich","1987-12-14","1","2020-12-04 09:41:20","1");
INSERT INTO cliente VALUES("V-25702124","Mariajose","Mujica ","1995-04-25","1","2020-12-04 09:13:33","1");
INSERT INTO cliente VALUES("V-25702125","Jhonnaiker","Mujica ","1997-05-17","2","2020-12-04 09:26:14","1");
INSERT INTO cliente VALUES("V-26296674","Alfredo","Vazquez","1997-09-15","2","2020-12-04 09:27:13","1");
INSERT INTO cliente VALUES("V-28822543","Jennifer","Vazquez ","2001-10-09","1","2020-12-04 09:45:01","1");
INSERT INTO cliente VALUES("V-3367559","Angel","Ruiz","1980-12-20","2","2020-12-03 10:29:12","1");
INSERT INTO cliente VALUES("V-7453435","Luis","Herrera","1990-12-10","2","2020-12-03 10:29:00","1");
INSERT INTO cliente VALUES("V-7686967","Michael","Jackson","2000-12-20","2","2020-12-04 09:24:35","0");
INSERT INTO cliente VALUES("V-8795594","Yelitza","Aparicio","1999-06-23","1","2020-12-03 10:29:40","1");



CREATE TABLE `correo_cliente` (
  `ci_cliente` varchar(20) NOT NULL,
  `correo_cliente` varchar(50) NOT NULL,
  `iddominio` int(11) NOT NULL,
  PRIMARY KEY (`ci_cliente`,`correo_cliente`,`iddominio`) USING BTREE,
  KEY `iddominio` (`iddominio`),
  CONSTRAINT `correo_cliente_ibfk_1` FOREIGN KEY (`ci_cliente`) REFERENCES `cliente` (`ci_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `correo_cliente_ibfk_2` FOREIGN KEY (`iddominio`) REFERENCES `dominio` (`iddominio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO correo_cliente VALUES("V-1111111","gsdf","2");
INSERT INTO correo_cliente VALUES("V-1234565","migzuel","2");
INSERT INTO correo_cliente VALUES("V-1768686","cathe_1","2");
INSERT INTO correo_cliente VALUES("V-2222222","migudsel","1");
INSERT INTO correo_cliente VALUES("V-22852963","vanessalaro","3");
INSERT INTO correo_cliente VALUES("V-2287970","anaisap","2");
INSERT INTO correo_cliente VALUES("V-24899571","dravaleria","1");
INSERT INTO correo_cliente VALUES("V-25702124","mariajosemmt","1");
INSERT INTO correo_cliente VALUES("V-25702125","jhonnaikermujic","1");
INSERT INTO correo_cliente VALUES("V-26296674","alfred2ft","1");
INSERT INTO correo_cliente VALUES("V-28822543","jenniferjvm","1");
INSERT INTO correo_cliente VALUES("V-3367559","ang1_2ruiz","2");
INSERT INTO correo_cliente VALUES("V-7453435","luish","1");
INSERT INTO correo_cliente VALUES("V-7686967","alfredo_arguinzones66","1");
INSERT INTO correo_cliente VALUES("V-8795594","yeli_2","1");



CREATE TABLE `correo_usuario` (
  `ci_usuario` varchar(20) NOT NULL,
  `correo_usuario` varchar(50) NOT NULL,
  `iddominio` int(11) NOT NULL,
  PRIMARY KEY (`ci_usuario`,`correo_usuario`,`iddominio`) USING BTREE,
  KEY `iddominio` (`iddominio`),
  CONSTRAINT `correo_usuario_ibfk_1` FOREIGN KEY (`ci_usuario`) REFERENCES `usuario` (`ci_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `correo_usuario_ibfk_2` FOREIGN KEY (`iddominio`) REFERENCES `dominio` (`iddominio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO correo_usuario VALUES("V-1111111","andre3_p","1");
INSERT INTO correo_usuario VALUES("V-1234567","gabo1","3");
INSERT INTO correo_usuario VALUES("V-19274216","esthermmendoza","1");
INSERT INTO correo_usuario VALUES("V-2222222","mesa_angela","2");
INSERT INTO correo_usuario VALUES("V-4444444","dom","3");
INSERT INTO correo_usuario VALUES("V-5555555","rodal","2");
INSERT INTO correo_usuario VALUES("V-5555555","rodri","4");
INSERT INTO correo_usuario VALUES("V-6666666","mari_contr","3");
INSERT INTO correo_usuario VALUES("V-8798448","gabrielaarguin","3");
INSERT INTO correo_usuario VALUES("V-8888888","gabrielaargudfgi12","2");



CREATE TABLE `direccion` (
  `ci_cliente` varchar(20) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_ciudad` int(11) NOT NULL,
  `id_municipio` int(11) NOT NULL,
  `detalle_direccion` varchar(200) NOT NULL,
  PRIMARY KEY (`ci_cliente`,`id_estado`,`id_ciudad`,`id_municipio`) USING BTREE,
  KEY `codmunicipio` (`id_municipio`),
  KEY `id_ciudad` (`id_ciudad`),
  KEY `id_estado` (`id_estado`),
  CONSTRAINT `direccion_ibfk_6` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id_estado`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `direccion_ibfk_7` FOREIGN KEY (`ci_cliente`) REFERENCES `cliente` (`ci_cliente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO direccion VALUES("V-1111111","7","120","83","");
INSERT INTO direccion VALUES("V-1234565","14","279","232","");
INSERT INTO direccion VALUES("V-1768686","7","127","90","");
INSERT INTO direccion VALUES("V-2222222","6","94","69","");
INSERT INTO direccion VALUES("V-22852963","17","340","285","");
INSERT INTO direccion VALUES("V-2287970","24","149","462","");
INSERT INTO direccion VALUES("V-24899571","16","324","272","");
INSERT INTO direccion VALUES("V-25702124","14","279","232","Santa Eulalia ");
INSERT INTO direccion VALUES("V-25702125","3","49","33","");
INSERT INTO direccion VALUES("V-26296674","20","416","371","");
INSERT INTO direccion VALUES("V-28822543","22","453","407","");
INSERT INTO direccion VALUES("V-3367559","14","284","235","Las Minas");
INSERT INTO direccion VALUES("V-7453435","24","150","462","Edificio Alfredo");
INSERT INTO direccion VALUES("V-7686967","9","148","101","Centro");
INSERT INTO direccion VALUES("V-8795594","24","149","462","");



CREATE TABLE `dominio` (
  `iddominio` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_dominio` varchar(20) NOT NULL,
  PRIMARY KEY (`iddominio`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO dominio VALUES("1","@gmail.com");
INSERT INTO dominio VALUES("2","@yahoo.com");
INSERT INTO dominio VALUES("3","@hotmail.com");
INSERT INTO dominio VALUES("4","@outlook.com");



CREATE TABLE `estados` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(250) NOT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

INSERT INTO estados VALUES("1","Amazonas");
INSERT INTO estados VALUES("2","Anzoátegui");
INSERT INTO estados VALUES("3","Apure");
INSERT INTO estados VALUES("4","Aragua");
INSERT INTO estados VALUES("5","Barinas");
INSERT INTO estados VALUES("6","Bolívar");
INSERT INTO estados VALUES("7","Carabobo");
INSERT INTO estados VALUES("8","Cojedes");
INSERT INTO estados VALUES("9","Delta Amacuro");
INSERT INTO estados VALUES("10","Falcón");
INSERT INTO estados VALUES("11","Guárico");
INSERT INTO estados VALUES("12","Lara");
INSERT INTO estados VALUES("13","Mérida");
INSERT INTO estados VALUES("14","Miranda");
INSERT INTO estados VALUES("15","Monagas");
INSERT INTO estados VALUES("16","Nueva Esparta");
INSERT INTO estados VALUES("17","Portuguesa");
INSERT INTO estados VALUES("18","Sucre");
INSERT INTO estados VALUES("19","Táchira");
INSERT INTO estados VALUES("20","Trujillo");
INSERT INTO estados VALUES("21","Vargas");
INSERT INTO estados VALUES("22","Yaracuy");
INSERT INTO estados VALUES("23","Zulia");
INSERT INTO estados VALUES("24","Distrito Capital");



CREATE TABLE `genero` (
  `codgenero` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(30) NOT NULL,
  PRIMARY KEY (`codgenero`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO genero VALUES("1","Femenino");
INSERT INTO genero VALUES("2","Masculino");



CREATE TABLE `municipios` (
  `id_municipio` int(11) NOT NULL AUTO_INCREMENT,
  `id_estado` int(11) NOT NULL,
  `municipio` varchar(100) NOT NULL,
  PRIMARY KEY (`id_municipio`),
  KEY `id_estado` (`id_estado`),
  CONSTRAINT `municipios_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id_estado`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=463 DEFAULT CHARSET=utf8;

INSERT INTO municipios VALUES("1","1","Alto Orinoco");
INSERT INTO municipios VALUES("2","1","Atabapo");
INSERT INTO municipios VALUES("3","1","Atures");
INSERT INTO municipios VALUES("4","1","Autana");
INSERT INTO municipios VALUES("5","1","Manapiare");
INSERT INTO municipios VALUES("6","1","Maroa");
INSERT INTO municipios VALUES("7","1","Río Negro");
INSERT INTO municipios VALUES("8","2","Anaco");
INSERT INTO municipios VALUES("9","2","Aragua");
INSERT INTO municipios VALUES("10","2","Manuel Ezequiel Bruzual");
INSERT INTO municipios VALUES("11","2","Diego Bautista Urbaneja");
INSERT INTO municipios VALUES("12","2","Fernando Peñalver");
INSERT INTO municipios VALUES("13","2","Francisco Del Carmen Carvajal");
INSERT INTO municipios VALUES("14","2","General Sir Arthur McGregor");
INSERT INTO municipios VALUES("15","2","Guanta");
INSERT INTO municipios VALUES("16","2","Independencia");
INSERT INTO municipios VALUES("17","2","José Gregorio Monagas");
INSERT INTO municipios VALUES("18","2","Juan Antonio Sotillo");
INSERT INTO municipios VALUES("19","2","Juan Manuel Cajigal");
INSERT INTO municipios VALUES("20","2","Libertad");
INSERT INTO municipios VALUES("21","2","Francisco de Miranda");
INSERT INTO municipios VALUES("22","2","Pedro María Freites");
INSERT INTO municipios VALUES("23","2","Píritu");
INSERT INTO municipios VALUES("24","2","San José de Guanipa");
INSERT INTO municipios VALUES("25","2","San Juan de Capistrano");
INSERT INTO municipios VALUES("26","2","Santa Ana");
INSERT INTO municipios VALUES("27","2","Simón Bolívar");
INSERT INTO municipios VALUES("28","2","Simón Rodríguez");
INSERT INTO municipios VALUES("29","3","Achaguas");
INSERT INTO municipios VALUES("30","3","Biruaca");
INSERT INTO municipios VALUES("31","3","Muñóz");
INSERT INTO municipios VALUES("32","3","Páez");
INSERT INTO municipios VALUES("33","3","Pedro Camejo");
INSERT INTO municipios VALUES("34","3","Rómulo Gallegos");
INSERT INTO municipios VALUES("35","3","San Fernando");
INSERT INTO municipios VALUES("36","4","Atanasio Girardot");
INSERT INTO municipios VALUES("37","4","Bolívar");
INSERT INTO municipios VALUES("38","4","Camatagua");
INSERT INTO municipios VALUES("39","4","Francisco Linares Alcántara");
INSERT INTO municipios VALUES("40","4","José Ángel Lamas");
INSERT INTO municipios VALUES("41","4","José Félix Ribas");
INSERT INTO municipios VALUES("42","4","José Rafael Revenga");
INSERT INTO municipios VALUES("43","4","Libertador");
INSERT INTO municipios VALUES("44","4","Mario Briceño Iragorry");
INSERT INTO municipios VALUES("45","4","Ocumare de la Costa de Oro");
INSERT INTO municipios VALUES("46","4","San Casimiro");
INSERT INTO municipios VALUES("47","4","San Sebastián");
INSERT INTO municipios VALUES("48","4","Santiago Mariño");
INSERT INTO municipios VALUES("49","4","Santos Michelena");
INSERT INTO municipios VALUES("50","4","Sucre");
INSERT INTO municipios VALUES("51","4","Tovar");
INSERT INTO municipios VALUES("52","4","Urdaneta");
INSERT INTO municipios VALUES("53","4","Zamora");
INSERT INTO municipios VALUES("54","5","Alberto Arvelo Torrealba");
INSERT INTO municipios VALUES("55","5","Andrés Eloy Blanco");
INSERT INTO municipios VALUES("56","5","Antonio José de Sucre");
INSERT INTO municipios VALUES("57","5","Arismendi");
INSERT INTO municipios VALUES("58","5","Barinas");
INSERT INTO municipios VALUES("59","5","Bolívar");
INSERT INTO municipios VALUES("60","5","Cruz Paredes");
INSERT INTO municipios VALUES("61","5","Ezequiel Zamora");
INSERT INTO municipios VALUES("62","5","Obispos");
INSERT INTO municipios VALUES("63","5","Pedraza");
INSERT INTO municipios VALUES("64","5","Rojas");
INSERT INTO municipios VALUES("65","5","Sosa");
INSERT INTO municipios VALUES("66","6","Caroní");
INSERT INTO municipios VALUES("67","6","Cedeño");
INSERT INTO municipios VALUES("68","6","El Callao");
INSERT INTO municipios VALUES("69","6","Gran Sabana");
INSERT INTO municipios VALUES("70","6","Heres");
INSERT INTO municipios VALUES("71","6","Piar");
INSERT INTO municipios VALUES("72","6","Angostura (Raúl Leoni)");
INSERT INTO municipios VALUES("73","6","Roscio");
INSERT INTO municipios VALUES("74","6","Sifontes");
INSERT INTO municipios VALUES("75","6","Sucre");
INSERT INTO municipios VALUES("76","6","Padre Pedro Chien");
INSERT INTO municipios VALUES("77","7","Bejuma");
INSERT INTO municipios VALUES("78","7","Carlos Arvelo");
INSERT INTO municipios VALUES("79","7","Diego Ibarra");
INSERT INTO municipios VALUES("80","7","Guacara");
INSERT INTO municipios VALUES("81","7","Juan José Mora");
INSERT INTO municipios VALUES("82","7","Libertador");
INSERT INTO municipios VALUES("83","7","Los Guayos");
INSERT INTO municipios VALUES("84","7","Miranda");
INSERT INTO municipios VALUES("85","7","Montalbán");
INSERT INTO municipios VALUES("86","7","Naguanagua");
INSERT INTO municipios VALUES("87","7","Puerto Cabello");
INSERT INTO municipios VALUES("88","7","San Diego");
INSERT INTO municipios VALUES("89","7","San Joaquín");
INSERT INTO municipios VALUES("90","7","Valencia");
INSERT INTO municipios VALUES("91","8","Anzoátegui");
INSERT INTO municipios VALUES("92","8","Tinaquillo");
INSERT INTO municipios VALUES("93","8","Girardot");
INSERT INTO municipios VALUES("94","8","Lima Blanco");
INSERT INTO municipios VALUES("95","8","Pao de San Juan Bautista");
INSERT INTO municipios VALUES("96","8","Ricaurte");
INSERT INTO municipios VALUES("97","8","Rómulo Gallegos");
INSERT INTO municipios VALUES("98","8","San Carlos");
INSERT INTO municipios VALUES("99","8","Tinaco");
INSERT INTO municipios VALUES("100","9","Antonio Díaz");
INSERT INTO municipios VALUES("101","9","Casacoima");
INSERT INTO municipios VALUES("102","9","Pedernales");
INSERT INTO municipios VALUES("103","9","Tucupita");
INSERT INTO municipios VALUES("104","10","Acosta");
INSERT INTO municipios VALUES("105","10","Bolívar");
INSERT INTO municipios VALUES("106","10","Buchivacoa");
INSERT INTO municipios VALUES("107","10","Cacique Manaure");
INSERT INTO municipios VALUES("108","10","Carirubana");
INSERT INTO municipios VALUES("109","10","Colina");
INSERT INTO municipios VALUES("110","10","Dabajuro");
INSERT INTO municipios VALUES("111","10","Democracia");
INSERT INTO municipios VALUES("112","10","Falcón");
INSERT INTO municipios VALUES("113","10","Federación");
INSERT INTO municipios VALUES("114","10","Jacura");
INSERT INTO municipios VALUES("115","10","José Laurencio Silva");
INSERT INTO municipios VALUES("116","10","Los Taques");
INSERT INTO municipios VALUES("117","10","Mauroa");
INSERT INTO municipios VALUES("118","10","Miranda");
INSERT INTO municipios VALUES("119","10","Monseñor Iturriza");
INSERT INTO municipios VALUES("120","10","Palmasola");
INSERT INTO municipios VALUES("121","10","Petit");
INSERT INTO municipios VALUES("122","10","Píritu");
INSERT INTO municipios VALUES("123","10","San Francisco");
INSERT INTO municipios VALUES("124","10","Sucre");
INSERT INTO municipios VALUES("125","10","Tocópero");
INSERT INTO municipios VALUES("126","10","Unión");
INSERT INTO municipios VALUES("127","10","Urumaco");
INSERT INTO municipios VALUES("128","10","Zamora");
INSERT INTO municipios VALUES("129","11","Camaguán");
INSERT INTO municipios VALUES("130","11","Chaguaramas");
INSERT INTO municipios VALUES("131","11","El Socorro");
INSERT INTO municipios VALUES("132","11","José Félix Ribas");
INSERT INTO municipios VALUES("133","11","José Tadeo Monagas");
INSERT INTO municipios VALUES("134","11","Juan Germán Roscio");
INSERT INTO municipios VALUES("135","11","Julián Mellado");
INSERT INTO municipios VALUES("136","11","Las Mercedes");
INSERT INTO municipios VALUES("137","11","Leonardo Infante");
INSERT INTO municipios VALUES("138","11","Pedro Zaraza");
INSERT INTO municipios VALUES("139","11","Ortíz");
INSERT INTO municipios VALUES("140","11","San Gerónimo de Guayabal");
INSERT INTO municipios VALUES("141","11","San José de Guaribe");
INSERT INTO municipios VALUES("142","11","Santa María de Ipire");
INSERT INTO municipios VALUES("143","11","Sebastián Francisco de Miranda");
INSERT INTO municipios VALUES("144","12","Andrés Eloy Blanco");
INSERT INTO municipios VALUES("145","12","Crespo");
INSERT INTO municipios VALUES("146","12","Iribarren");
INSERT INTO municipios VALUES("147","12","Jiménez");
INSERT INTO municipios VALUES("148","12","Morán");
INSERT INTO municipios VALUES("149","12","Palavecino");
INSERT INTO municipios VALUES("150","12","Simón Planas");
INSERT INTO municipios VALUES("151","12","Torres");
INSERT INTO municipios VALUES("152","12","Urdaneta");
INSERT INTO municipios VALUES("179","13","Alberto Adriani");
INSERT INTO municipios VALUES("180","13","Andrés Bello");
INSERT INTO municipios VALUES("181","13","Antonio Pinto Salinas");
INSERT INTO municipios VALUES("182","13","Aricagua");
INSERT INTO municipios VALUES("183","13","Arzobispo Chacón");
INSERT INTO municipios VALUES("184","13","Campo Elías");
INSERT INTO municipios VALUES("185","13","Caracciolo Parra Olmedo");
INSERT INTO municipios VALUES("186","13","Cardenal Quintero");
INSERT INTO municipios VALUES("187","13","Guaraque");
INSERT INTO municipios VALUES("188","13","Julio César Salas");
INSERT INTO municipios VALUES("189","13","Justo Briceño");
INSERT INTO municipios VALUES("190","13","Libertador");
INSERT INTO municipios VALUES("191","13","Miranda");
INSERT INTO municipios VALUES("192","13","Obispo Ramos de Lora");
INSERT INTO municipios VALUES("193","13","Padre Noguera");
INSERT INTO municipios VALUES("194","13","Pueblo Llano");
INSERT INTO municipios VALUES("195","13","Rangel");
INSERT INTO municipios VALUES("196","13","Rivas Dávila");
INSERT INTO municipios VALUES("197","13","Santos Marquina");
INSERT INTO municipios VALUES("198","13","Sucre");
INSERT INTO municipios VALUES("199","13","Tovar");
INSERT INTO municipios VALUES("200","13","Tulio Febres Cordero");
INSERT INTO municipios VALUES("201","13","Zea");
INSERT INTO municipios VALUES("223","14","Acevedo");
INSERT INTO municipios VALUES("224","14","Andrés Bello");
INSERT INTO municipios VALUES("225","14","Baruta");
INSERT INTO municipios VALUES("226","14","Brión");
INSERT INTO municipios VALUES("227","14","Buroz");
INSERT INTO municipios VALUES("228","14","Carrizal");
INSERT INTO municipios VALUES("229","14","Chacao");
INSERT INTO municipios VALUES("230","14","Cristóbal Rojas");
INSERT INTO municipios VALUES("231","14","El Hatillo");
INSERT INTO municipios VALUES("232","14","Guaicaipuro");
INSERT INTO municipios VALUES("233","14","Independencia");
INSERT INTO municipios VALUES("234","14","Lander");
INSERT INTO municipios VALUES("235","14","Los Salias");
INSERT INTO municipios VALUES("236","14","Páez");
INSERT INTO municipios VALUES("237","14","Paz Castillo");
INSERT INTO municipios VALUES("238","14","Pedro Gual");
INSERT INTO municipios VALUES("239","14","Plaza");
INSERT INTO municipios VALUES("240","14","Simón Bolívar");
INSERT INTO municipios VALUES("241","14","Sucre");
INSERT INTO municipios VALUES("242","14","Urdaneta");
INSERT INTO municipios VALUES("243","14","Zamora");
INSERT INTO municipios VALUES("258","15","Acosta");
INSERT INTO municipios VALUES("259","15","Aguasay");
INSERT INTO municipios VALUES("260","15","Bolívar");
INSERT INTO municipios VALUES("261","15","Caripe");
INSERT INTO municipios VALUES("262","15","Cedeño");
INSERT INTO municipios VALUES("263","15","Ezequiel Zamora");
INSERT INTO municipios VALUES("264","15","Libertador");
INSERT INTO municipios VALUES("265","15","Maturín");
INSERT INTO municipios VALUES("266","15","Piar");
INSERT INTO municipios VALUES("267","15","Punceres");
INSERT INTO municipios VALUES("268","15","Santa Bárbara");
INSERT INTO municipios VALUES("269","15","Sotillo");
INSERT INTO municipios VALUES("270","15","Uracoa");
INSERT INTO municipios VALUES("271","16","Antolín del Campo");
INSERT INTO municipios VALUES("272","16","Arismendi");
INSERT INTO municipios VALUES("273","16","García");
INSERT INTO municipios VALUES("274","16","Gómez");
INSERT INTO municipios VALUES("275","16","Maneiro");
INSERT INTO municipios VALUES("276","16","Marcano");
INSERT INTO municipios VALUES("277","16","Mariño");
INSERT INTO municipios VALUES("278","16","Península de Macanao");
INSERT INTO municipios VALUES("279","16","Tubores");
INSERT INTO municipios VALUES("280","16","Villalba");
INSERT INTO municipios VALUES("281","16","Díaz");
INSERT INTO municipios VALUES("282","17","Agua Blanca");
INSERT INTO municipios VALUES("283","17","Araure");
INSERT INTO municipios VALUES("284","17","Esteller");
INSERT INTO municipios VALUES("285","17","Guanare");
INSERT INTO municipios VALUES("286","17","Guanarito");
INSERT INTO municipios VALUES("287","17","Monseñor José Vicente de Unda");
INSERT INTO municipios VALUES("288","17","Ospino");
INSERT INTO municipios VALUES("289","17","Páez");
INSERT INTO municipios VALUES("290","17","Papelón");
INSERT INTO municipios VALUES("291","17","San Genaro de Boconoíto");
INSERT INTO municipios VALUES("292","17","San Rafael de Onoto");
INSERT INTO municipios VALUES("293","17","Santa Rosalía");
INSERT INTO municipios VALUES("294","17","Sucre");
INSERT INTO municipios VALUES("295","17","Turén");
INSERT INTO municipios VALUES("296","18","Andrés Eloy Blanco");
INSERT INTO municipios VALUES("297","18","Andrés Mata");
INSERT INTO municipios VALUES("298","18","Arismendi");
INSERT INTO municipios VALUES("299","18","Benítez");
INSERT INTO municipios VALUES("300","18","Bermúdez");
INSERT INTO municipios VALUES("301","18","Bolívar");
INSERT INTO municipios VALUES("302","18","Cajigal");
INSERT INTO municipios VALUES("303","18","Cruz Salmerón Acosta");
INSERT INTO municipios VALUES("304","18","Libertador");
INSERT INTO municipios VALUES("305","18","Mariño");
INSERT INTO municipios VALUES("306","18","Mejía");
INSERT INTO municipios VALUES("307","18","Montes");
INSERT INTO municipios VALUES("308","18","Ribero");
INSERT INTO municipios VALUES("309","18","Sucre");
INSERT INTO municipios VALUES("310","18","Valdéz");
INSERT INTO municipios VALUES("341","19","Andrés Bello");
INSERT INTO municipios VALUES("342","19","Antonio Rómulo Costa");
INSERT INTO municipios VALUES("343","19","Ayacucho");
INSERT INTO municipios VALUES("344","19","Bolívar");
INSERT INTO municipios VALUES("345","19","Cárdenas");
INSERT INTO municipios VALUES("346","19","Córdoba");
INSERT INTO municipios VALUES("347","19","Fernández Feo");
INSERT INTO municipios VALUES("348","19","Francisco de Miranda");
INSERT INTO municipios VALUES("349","19","García de Hevia");
INSERT INTO municipios VALUES("350","19","Guásimos");
INSERT INTO municipios VALUES("351","19","Independencia");
INSERT INTO municipios VALUES("352","19","Jáuregui");
INSERT INTO municipios VALUES("353","19","José María Vargas");
INSERT INTO municipios VALUES("354","19","Junín");
INSERT INTO municipios VALUES("355","19","Libertad");
INSERT INTO municipios VALUES("356","19","Libertador");
INSERT INTO municipios VALUES("357","19","Lobatera");
INSERT INTO municipios VALUES("358","19","Michelena");
INSERT INTO municipios VALUES("359","19","Panamericano");
INSERT INTO municipios VALUES("360","19","Pedro María Ureña");
INSERT INTO municipios VALUES("361","19","Rafael Urdaneta");
INSERT INTO municipios VALUES("362","19","Samuel Darío Maldonado");
INSERT INTO municipios VALUES("363","19","San Cristóbal");
INSERT INTO municipios VALUES("364","19","Seboruco");
INSERT INTO municipios VALUES("365","19","Simón Rodríguez");
INSERT INTO municipios VALUES("366","19","Sucre");
INSERT INTO municipios VALUES("367","19","Torbes");
INSERT INTO municipios VALUES("368","19","Uribante");
INSERT INTO municipios VALUES("369","19","San Judas Tadeo");
INSERT INTO municipios VALUES("370","20","Andrés Bello");
INSERT INTO municipios VALUES("371","20","Boconó");
INSERT INTO municipios VALUES("372","20","Bolívar");
INSERT INTO municipios VALUES("373","20","Candelaria");
INSERT INTO municipios VALUES("374","20","Carache");
INSERT INTO municipios VALUES("375","20","Escuque");
INSERT INTO municipios VALUES("376","20","José Felipe Márquez Cañizalez");
INSERT INTO municipios VALUES("377","20","Juan Vicente Campos Elías");
INSERT INTO municipios VALUES("378","20","La Ceiba");
INSERT INTO municipios VALUES("379","20","Miranda");
INSERT INTO municipios VALUES("380","20","Monte Carmelo");
INSERT INTO municipios VALUES("381","20","Motatán");
INSERT INTO municipios VALUES("382","20","Pampán");
INSERT INTO municipios VALUES("383","20","Pampanito");
INSERT INTO municipios VALUES("384","20","Rafael Rangel");
INSERT INTO municipios VALUES("385","20","San Rafael de Carvajal");
INSERT INTO municipios VALUES("386","20","Sucre");
INSERT INTO municipios VALUES("387","20","Trujillo");
INSERT INTO municipios VALUES("388","20","Urdaneta");
INSERT INTO municipios VALUES("389","20","Valera");
INSERT INTO municipios VALUES("390","21","Vargas");
INSERT INTO municipios VALUES("391","22","Arístides Bastidas");
INSERT INTO municipios VALUES("392","22","Bolívar");
INSERT INTO municipios VALUES("407","22","Bruzual");
INSERT INTO municipios VALUES("408","22","Cocorote");
INSERT INTO municipios VALUES("409","22","Independencia");
INSERT INTO municipios VALUES("410","22","José Antonio Páez");
INSERT INTO municipios VALUES("411","22","La Trinidad");
INSERT INTO municipios VALUES("412","22","Manuel Monge");
INSERT INTO municipios VALUES("413","22","Nirgua");
INSERT INTO municipios VALUES("414","22","Peña");
INSERT INTO municipios VALUES("415","22","San Felipe");
INSERT INTO municipios VALUES("416","22","Sucre");
INSERT INTO municipios VALUES("417","22","Urachiche");
INSERT INTO municipios VALUES("418","22","José Joaquín Veroes");
INSERT INTO municipios VALUES("441","23","Almirante Padilla");
INSERT INTO municipios VALUES("442","23","Baralt");
INSERT INTO municipios VALUES("443","23","Cabimas");
INSERT INTO municipios VALUES("444","23","Catatumbo");
INSERT INTO municipios VALUES("445","23","Colón");
INSERT INTO municipios VALUES("446","23","Francisco Javier Pulgar");
INSERT INTO municipios VALUES("447","23","Páez");
INSERT INTO municipios VALUES("448","23","Jesús Enrique Losada");
INSERT INTO municipios VALUES("449","23","Jesús María Semprún");
INSERT INTO municipios VALUES("450","23","La Cañada de Urdaneta");
INSERT INTO municipios VALUES("451","23","Lagunillas");
INSERT INTO municipios VALUES("452","23","Machiques de Perijá");
INSERT INTO municipios VALUES("453","23","Mara");
INSERT INTO municipios VALUES("454","23","Maracaibo");
INSERT INTO municipios VALUES("455","23","Miranda");
INSERT INTO municipios VALUES("456","23","Rosario de Perijá");
INSERT INTO municipios VALUES("457","23","San Francisco");
INSERT INTO municipios VALUES("458","23","Santa Rita");
INSERT INTO municipios VALUES("459","23","Simón Bolívar");
INSERT INTO municipios VALUES("460","23","Sucre");
INSERT INTO municipios VALUES("461","23","Valmore Rodríguez");
INSERT INTO municipios VALUES("462","24","Libertador");



CREATE TABLE `rol` (
  `idrol` int(11) NOT NULL AUTO_INCREMENT,
  `nombrerol` varchar(20) NOT NULL,
  PRIMARY KEY (`idrol`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO rol VALUES("1","Administrador");
INSERT INTO rol VALUES("2","Cosmetólogo");
INSERT INTO rol VALUES("3","Secretario");



CREATE TABLE `servicio` (
  `idservicio` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_servicio` varchar(30) NOT NULL,
  PRIMARY KEY (`idservicio`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

INSERT INTO servicio VALUES("1","Manicure");
INSERT INTO servicio VALUES("3","Pedicure");
INSERT INTO servicio VALUES("7","Limpieza de cutis");
INSERT INTO servicio VALUES("8","Masajes");
INSERT INTO servicio VALUES("9","Alisados");
INSERT INTO servicio VALUES("10","Cortes");
INSERT INTO servicio VALUES("14","DepilaciÃ³n lÃ¡ser");
INSERT INTO servicio VALUES("16","Lifting japonÃ©s");
INSERT INTO servicio VALUES("17","MicrodermabrasiÃ³n");
INSERT INTO servicio VALUES("18","DermabrasiÃ³n");
INSERT INTO servicio VALUES("19","Cera caliente y frÃ­a");
INSERT INTO servicio VALUES("20","Ãcido HialurÃ³nico");



CREATE TABLE `status` (
  `idatatus` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`idatatus`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO status VALUES("1","Pendiente");
INSERT INTO status VALUES("2","Asistió");
INSERT INTO status VALUES("3","No asistió");
INSERT INTO status VALUES("4","Cancelado");



CREATE TABLE `telefono_cliente` (
  `ci_cliente` varchar(20) NOT NULL,
  `idarea` int(11) NOT NULL,
  `telefono_cliente` int(11) NOT NULL,
  PRIMARY KEY (`ci_cliente`,`idarea`,`telefono_cliente`) USING BTREE,
  KEY `idarea` (`idarea`),
  CONSTRAINT `telefono_cliente_ibfk_1` FOREIGN KEY (`ci_cliente`) REFERENCES `cliente` (`ci_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `telefono_cliente_ibfk_2` FOREIGN KEY (`idarea`) REFERENCES `area` (`idarea`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO telefono_cliente VALUES("V-1111111","4","7766878");
INSERT INTO telefono_cliente VALUES("V-1111111","5","5656565");
INSERT INTO telefono_cliente VALUES("V-1234565","2","7675757");
INSERT INTO telefono_cliente VALUES("V-1768686","2","5111158");
INSERT INTO telefono_cliente VALUES("V-2222222","4","5464748");
INSERT INTO telefono_cliente VALUES("V-22852963","4","2529319");
INSERT INTO telefono_cliente VALUES("V-2287970","5","2222222");
INSERT INTO telefono_cliente VALUES("V-24899571","2","4987519");
INSERT INTO telefono_cliente VALUES("V-25702124","1","5418881");
INSERT INTO telefono_cliente VALUES("V-25702125","1","2975469");
INSERT INTO telefono_cliente VALUES("V-26296674","2","1088966");
INSERT INTO telefono_cliente VALUES("V-28822543","1","5443573");
INSERT INTO telefono_cliente VALUES("V-3367559","6","2323232");
INSERT INTO telefono_cliente VALUES("V-7453435","2","3333333");
INSERT INTO telefono_cliente VALUES("V-7686967","4","4444444");
INSERT INTO telefono_cliente VALUES("V-8795594","1","2222222");



CREATE TABLE `telefono_usuario` (
  `ci_usuario` varchar(20) NOT NULL,
  `idarea` int(11) NOT NULL,
  `telefono_usuario` int(11) NOT NULL,
  PRIMARY KEY (`ci_usuario`,`idarea`,`telefono_usuario`) USING BTREE,
  KEY `idarea` (`idarea`),
  CONSTRAINT `telefono_usuario_ibfk_1` FOREIGN KEY (`ci_usuario`) REFERENCES `usuario` (`ci_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `telefono_usuario_ibfk_2` FOREIGN KEY (`idarea`) REFERENCES `area` (`idarea`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO telefono_usuario VALUES("V-1111111","1","1111111");
INSERT INTO telefono_usuario VALUES("V-1111111","1","2222222");
INSERT INTO telefono_usuario VALUES("V-1234567","4","1234597");
INSERT INTO telefono_usuario VALUES("V-19274216","1","5553696");
INSERT INTO telefono_usuario VALUES("V-2222222","1","3333333");
INSERT INTO telefono_usuario VALUES("V-4444444","1","1212121");
INSERT INTO telefono_usuario VALUES("V-4444444","1","4444444");
INSERT INTO telefono_usuario VALUES("V-5555555","1","5555555");
INSERT INTO telefono_usuario VALUES("V-6666666","3","5555555");
INSERT INTO telefono_usuario VALUES("V-8798448","2","1111111");
INSERT INTO telefono_usuario VALUES("V-8888888","3","4545454");



CREATE TABLE `trabajo` (
  `ci_cosmetologa` varchar(20) NOT NULL,
  `idservicio` int(11) NOT NULL,
  `horario_inicio` time NOT NULL,
  `horario_final` time NOT NULL,
  PRIMARY KEY (`ci_cosmetologa`,`idservicio`) USING BTREE,
  KEY `idservicio` (`idservicio`),
  CONSTRAINT `trabajo_ibfk_1` FOREIGN KEY (`idservicio`) REFERENCES `servicio` (`idservicio`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `trabajo_ibfk_2` FOREIGN KEY (`ci_cosmetologa`) REFERENCES `usuario` (`ci_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO trabajo VALUES("V-1111111","1","09:00:00","13:00:00");
INSERT INTO trabajo VALUES("V-1111111","3","09:00:00","13:00:00");
INSERT INTO trabajo VALUES("V-19274216","14","08:00:00","17:00:00");
INSERT INTO trabajo VALUES("V-19274216","18","08:00:00","17:00:00");
INSERT INTO trabajo VALUES("V-2222222","7","08:00:00","19:00:00");
INSERT INTO trabajo VALUES("V-4444444","1","08:00:00","19:00:00");
INSERT INTO trabajo VALUES("V-4444444","9","10:00:00","12:30:00");



CREATE TABLE `usuario` (
  `ci_usuario` varchar(20) NOT NULL,
  `nombreu` varchar(50) NOT NULL,
  `apellidou` varchar(50) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `codgenero` int(11) NOT NULL,
  `idrol` int(11) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `fechaingreso` timestamp NOT NULL DEFAULT current_timestamp(),
  `estatus` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`ci_usuario`) USING BTREE,
  KEY `idrol` (`idrol`),
  KEY `codgenero` (`codgenero`),
  CONSTRAINT `usuario-genero` FOREIGN KEY (`codgenero`) REFERENCES `genero` (`codgenero`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `usuario-rol` FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO usuario VALUES("","","","admin","abcd1234","1","1","","2020-10-29 23:00:53","1");
INSERT INTO usuario VALUES("V-1111111","Andreinapp","Pérez","andrep","1234abcd","1","2","San Antonio, Las Minas, Edificio Pomarosa","2020-12-02 18:37:39","1");
INSERT INTO usuario VALUES("V-1234567","Gabriel","Caballero","angelc","abcd1234","2","2","Loma Alta","2020-12-03 09:33:34","1");
INSERT INTO usuario VALUES("V-19274216","Esther ","Mendoza ","estherm","ghost1234","1","2","La Rosaleda, San Antonio De Los Altos","2020-12-04 09:19:51","1");
INSERT INTO usuario VALUES("V-2222222","Angelah","Mesa","mesa_ang","abcd1234","1","2","Calle Rivas, Calle Roscio, Guaicaipuro, Los Teques","2020-12-02 18:48:13","1");
INSERT INTO usuario VALUES("V-4444444","Pablo","Dominguez","domp","abcd1234","2","2","San Antonio, Las Minas, Edificio Pomarosa","2020-12-02 19:42:21","1");
INSERT INTO usuario VALUES("V-5555555","Alex","Rodriguez","rodal","abcd1234","2","3","San Antonio, El Pueblo, Edificio Alfredo","2020-12-02 19:44:18","1");
INSERT INTO usuario VALUES("V-6666666","Maria","Contreras","contremar","abcd1234","1","2","San Antonio, Las Minas, Calle Luztran","2020-12-02 20:02:52","1");
INSERT INTO usuario VALUES("V-8798448","Andreina","Pérez","android","abcd1234","2","3","San Antonio, Las Minas, Edificio Pomarosa","2020-12-02 23:24:01","1");
INSERT INTO usuario VALUES("V-8888888","Alejandro ","Ugas","ugasAle","abcd1234","2","2","San Antonio, El Picacho","2020-12-02 22:31:40","1");

