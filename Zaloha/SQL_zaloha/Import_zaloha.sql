
INSERT INTO `blog` (`idBlog`, `aktualita`, `verejne`, `nadpis`, `predtext`, `text`, `datum`, `os_udaje_rod_cislo`, `platnost_od`, `platnost_do`) VALUES
(1, 0, 1, 'Europe Direct Žilina, Univerzitná knižnica UNIZA pokračuje', 'Od prvého mája začala fungovať nová generácia približne 424 informačných centier EUROPE DIRECT v celej EÚ. Na Slovensku ich bude 12.\r\n\r\nS radosťou Vám oznamujeme, že Europe Direct Žilina, Univerzitná knižnica UNIZA pokračuje vo svojej činnosti ďalších 5 rokov.', '', '2021-05-04', '961102/1111', NULL, NULL),
(2, 0, 0, 'Zasadnutie Akademického senátu UNIZA', 'Dovoľujeme si Vám oznámiť, že verejné zasadnutie Akademického senátu Žilinskej univerzity v Žiline sa uskutoční dňa 19. apríla 2021 o 13:00 hod. Vzhľadom na aktuálnu situáciu sa zasadnutie uskutoční online, prostredníctvom videohovoru aplikácie MS Teams – link na prístup.\r\nPredbežný  program rokovania:\r\n\r\nNávrh výročnej správy o činnosti AS UNIZA za rok 2020.\r\nNávrh výročnej správy o činnosti Žilinskej univerzity v Žiline za rok 2020.\r\nDohoda o urovnaní uzatvorená podľa § 585 a nasl. Zákona č. 40/1964 Zb. Občianskeho zákonníka v znení neskorších predpisov medzi Žilinskou univerzitou v Žiline a mestom Liptovský Mikuláš.\r\nRôzne\r\nOznámenie funkcií, zamestnaní, činností a majetkových pomerov rektora UNIZA', '', '2021-05-04', '961102/1111', NULL, NULL),
(3, 0, 1, 'Výzva na podávanie Erasmus+ projektov v roku 2021', 'Dovoľujeme si Vás informovať o začatí nového programu Erasmus+ 2021-2027 a zverejnení Výzvy Erasmus+ na podávanie návrhov projektov a žiadostí o ich financovanie v roku 2021.\r\n\r\nPodrobné informácie k podmienkam prípravy projektov a termíny podávania projektov sú uvedené na stránke Národnej agentúry programu  Erasmus+ v Bratislave a na stránke Európskej komisie.\r\n\r\nRiešitelia zo slovenských VŠ, ktorí majú záujem o podanie Erasmus+ projektu, môžu svoj zámer konzultovať s pracovníkmi z Národnej agentúry Erasmus+ programu.', '', '2021-05-04', '961102/1111', NULL, NULL),
(4, 0, 1, 'Falling Walls 2021 - Online prihlasovanie spustené', 'V roku 2021 sa bude konať veľmi významné podujatie Falling Walls 2021.\r\n\r\nPodujatie je platformou pre mladých vedcov, podnikateľov a profesionálov zo všetkých oblastí. Umožňuje prezentovať výskumné aktivity, podnikateľské modely, inovatívne projekty či myšlienky pred ďalšími mladými inovátormi a váženou porotou z oblasti vedy, inovácií a biznisu.', '', '2021-05-04', '961102/1111', NULL, NULL),
(5, 1, 1, 'Národné kompetenčné centrum pre HPC organizuje Hackathon', 'Národné kompetenčné centrum pre HPC organizuje Hackathon 21. – 28. 5. 2021, cieľom ktorého je vývoj aplikácie pre slovenský superpočítač a jeho používateľov.\r\n\r\nV rámci podujatia by sme chceli vyvinúť aplikáciu pre iOS/android s modulmi určenými na získanie prehľadu o používateľových výpočtových úlohách a dostupných výpočtových prostriedkoch, informáciami o spotrebe energie a využití výpočtových kapacít.', 'Víťaz získa 1500 € a v hre sú ďalšie zaujímavé ceny ako napríklad tablet reMarkable, čítačku Kindle Oasis, slúchadlá Apple airpods, fitness náramok a iné!', '2021-05-04', '961102/1111', '2021-04-01', '2022-04-01'),
(6, 1, 0, 'Pozvánka – Virtuálny Schaefflerday 29. 4. 2021', 'Schaeffler Kysuce organizuje virtuálny Schaeffler deň pre študentov UNIZA. Bude sa konať 29. apríla 2021 od 10.00 - 12.30 hod.\r\n\r\nVšetky informácie o pripravovanom virtuálnom Schaefflerday sa dozviete v plagáte.', '', '2021-05-04', '961102/1111', NULL, NULL);

INSERT INTO `celoziv_vzdel` (`idprednasky`, `datum`, `nazov`, `verejne`, `miesto`, `popis`, `cena`, `Subor_idSubor`, `os_udaje_rod_cislo`) VALUES
(1, '2021-09-22', 'PHP pre začiatočníkov', 0, 'Uniza', '', 0, 27, '961102/1111'),
(2, '2021-11-26', 'Javascript', 1, 'UNIZA', 'Rýchla náuka javascriptu', 15, 28, '961102/1111');

INSERT INTO `formular` (`idformular`, `typ`, `vytvorenie`, `platnost_od`, `platnost_do`, `os_udaje_rod_cislo`) VALUES
(1, 1, '2021-05-04', '0000-00-00', '0000-00-00', '961102/1111');

INSERT INTO `funkcie` (`idPozícia`, `Nazov`) VALUES
(1, 'admin'),
(2, 'nezaradené'),
(3, 'Technik'),
(4, 'Administratíva'),
(5, 'Garant'),
(6, 'Pedagóg'),
(7, 'Dekan'),
(8, 'Prodekan'),
(9, 'Rektor'),
(10, 'Prorektor');

INSERT INTO `inzerat` (`id_inzerat`, `Titulok`, `Popis`, `vytvorenie`, `zobraz_telefon`, `cenovka`, `kategoria_id_kategoria`, `os_udaje_rod_cislo`) VALUES
(1, 'Hladám odvoz', 'BB-ZA', '2021-05-04', 0, 0, 3, '961102/1111'),
(2, 'Notebook', 'Ako nový', '2021-05-04', 0, 250, 1, '961102/1111'),
(3, 'Tvorba webstránok', 'Na požiadanie', '2021-05-04', 0, 0, 2, '961102/1111');

INSERT INTO `kategoria` (`id_kategoria`, `Názov`, `Subor_idSubor`) VALUES
(1, 'Elektronika', 6),
(2, 'Služby', 7),
(3, 'Hladám', 8);

INSERT INTO `kontakt` (`idkontakt`, `telefon`, `email`, `os_udaje_rod_cislo`, `priorita`, `nazov`) VALUES
(1, '+421907500822', 'miciz1.roka@gmail.com', '961102/1111', 0, NULL);

INSERT INTO `konverzacia` (`idKonverzacie`, `precitane`, `Uzivatel1`, `Uzivatel2`) VALUES
(1, 0, '961102/1111', '970112/1111');

INSERT INTO `login` (`idLogin`, `login`, `password`, `OS_udaje_rod_cislo`) VALUES
(1, 'adminus1', '96hR5IGsOwXA.', '961102/1111'),
(2, 'pitel1', '979KeolKVHXHo', '970112/1111'),
(3, 'toth1', '864/m3fS.HGa2', '860907/1259'),
(5, 'steinmuller1', '84QZkqVz3aNrM', '840312/7845'),
(6, 'balaz1', '83gb3.iV2cjiY', '830514/5341'),
(7, 'biely1', '84f0mvKPg2ULc', '841201/1248'),
(8, 'ratroch1', '85D//B7CsCor2', '850130/3695'),
(9, 'kapustny1', '78BjzQjj7AbKM', '781015/4431'),
(10, 'durica1', '80hfzJPlYRo6.', '800407/3522'),
(11, 'kluciar1', '79PjRAuX7E//6', '791229/5431'),
(12, 'satrapa1', '87ZYdZO38HYpg', '871124/3578'),
(13, 'krnac1', '87gXj3iuv96AE', '871203/5472'),
(14, 'papun1', '894tzSLeYiNpQ', '890310/2145'),
(15, 'janci1', '91v8YIGSIDX7U', '911001/3623'),
(16, 'svetkovsky1', '90pWkSQ0oSFP.', '901130/4454'),
(17, 'kontros1', '92Ozo2r0agId2', '921225/7452'),
(18, 'murgas1', '90xhvD26CiAWo', '900913/3326'),
(19, 'murgas2', '87ndWH1JGJtVY', '870913/3326'),
(20, 'lehotsky1', '892xTYUI/gQMs', '890608/4543'),
(21, 'kovac1', '86OiiY4g34DOg', '860103/2238'),
(22, 'slamova1', '898D8e7PdDVoA', '896123/5471'),
(23, 'lipovska1', '85g0L1BjVLP.A', '855122/8569'),
(24, 'mazur1', '83iWIKc6akP6U', '830914/7748'),
(25, 'gazo1', '8485xnVZlAEbw', '840410/6777'),
(26, 'sim1', '84ahSl573Hucw', '840409/7900'),
(27, 'olzbut1', '83SS7tfOx07oo', '830420/8088'),
(28, 'skuta1', '83tpOH/5tg.rM', '830301/7789'),
(29, 'brna1', '83i9LNugEHbBk', '831002/8463'),
(30, 'kominek1', '842gYQ.YcFLiY', '840307/7485'),
(31, 'cipak1', '84SDj8vkURylc', '840821/8027'),
(32, 'stelbasky1', '83F9LV4/Tcl/2', '830324/7887'),
(33, 'minarik1', '83iDp0HIOKHds', '830703/7486'),
(34, 'tuma1', '82cER1XCBRRZM', '820101/8452'),
(35, 'bucany1', '84iWyFw0VPDLg', '840409/7680'),
(36, 'korenciak1', '83y4ygpjBGKA2', '831204/7766'),
(37, 'gmuca1', '81kbL18DV0jFA', '810101/8079');

INSERT INTO `notifikacia` (`idNotifikacia`, `text`, `datum`, `Videne`, `os_udaje_rod_cislo`) VALUES
(1, 'Vaša pozícia bola zmenena.', '2021-05-04', 1, '961102/1111'),
(2, 'Vaša pozícia bola zmenena.', '2021-05-04', 1, '961102/1111'),
(3, 'Vaša pozícia bola zmenena.', '2021-05-04', 1, '961102/1111'),
(4, 'Vaša pozícia bola zmenena.', '2021-05-04', 1, '961102/1111'),
(5, 'Vaša pozícia bola zmenena.', '2021-05-04', 1, '961102/1111'),
(6, 'Vaša pozícia bola zmenena.', '2021-05-04', 1, '961102/1111'),
(7, 'Vaša pozícia bola zmenena.', '2021-05-04', 1, '961102/1111'),
(8, 'Vaša údaje boli pridané alebo zmenené administrátorom   .', '2021-05-04', 0, '970112/1111'),
(9, 'Vaša údaje boli pridané alebo zmenené administrátorom   .', '2021-05-04', 0, '970112/1111'),
(10, 'Vaša údaje boli pridané alebo zmenené administrátorom   .', '2021-05-04', 0, '970112/1111'),
(11, 'Vaša údaje boli pridané alebo zmenené administrátorom   .', '2021-05-04', 0, '970112/1111'),
(12, 'Vaša údaje boli pridané alebo zmenené administrátorom   .', '2021-05-04', 0, '970112/1111'),
(13, 'Inzerát na ktorý ste boli prihlásený bol práve zmazaný.', '2021-05-04', 0, '970112/1111');

INSERT INTO `os_udaje` (`rod_cislo`, `miestnost`, `Meno`, `titul_pred`, `Priezvisko`, `titul_za`, `Pracovisko_idPracovisko`, `subor_fotka`, `subor_CV`, `IBAN`, `PSC`, `Mesto`, `Adresa`) VALUES
('781015/4431', NULL, 'Peter', NULL, 'Kapustny', NULL, 1, NULL, NULL, '', '', '', ''),
('791229/5431', NULL, 'Martin', NULL, 'Kluciar', NULL, 1, NULL, NULL, '', '', '', ''),
('800407/3522', NULL, 'Marek', NULL, 'Durica', NULL, 1, NULL, NULL, '', '', '', ''),
('810101/8079', NULL, 'Miroslav', NULL, 'Gmuca', NULL, 1, NULL, NULL, '', '', '', ''),
('820101/8452', NULL, 'Juraj', NULL, 'Tuma', NULL, 1, NULL, NULL, '', '', '', ''),
('830301/7789', NULL, 'Martin', NULL, 'Skuta', NULL, 1, NULL, NULL, '', '', '', ''),
('830324/7887', NULL, 'Peter', NULL, 'Stelbasky', NULL, 1, NULL, NULL, '', '', '', ''),
('830420/8088', NULL, 'Zdenko', NULL, 'Olzbut', NULL, 1, NULL, NULL, '', '', '', ''),
('830514/5341', NULL, 'Branislav', NULL, 'Balaz', NULL, 1, NULL, NULL, '', '', '', ''),
('830703/7486', NULL, 'Peter', NULL, 'Minarik', NULL, 1, NULL, NULL, '', '', '', ''),
('830914/7748', NULL, 'Robert', NULL, 'Mazur', NULL, 1, NULL, NULL, '', '', '', ''),
('831002/8463', NULL, 'Jozef', NULL, 'Brna', NULL, 1, NULL, NULL, '', '', '', ''),
('831204/7766', NULL, 'Peter', NULL, 'Korenciak', NULL, 1, NULL, NULL, '', '', '', ''),
('840307/7485', NULL, 'Lubomir', NULL, 'Kominek', NULL, 1, NULL, NULL, '', '', '', ''),
('840312/7845', NULL, 'Stanislav', NULL, 'Steinmuller', NULL, 1, NULL, NULL, '', '', '', ''),
('840409/7680', NULL, 'Dusan', NULL, 'Bucany', NULL, 1, NULL, NULL, '', '', '', ''),
('840409/7900', NULL, 'Zoltan', NULL, 'Sim', NULL, 1, NULL, NULL, '', '', '', ''),
('840410/6777', NULL, 'Alojz', NULL, 'Gazo', NULL, 1, NULL, NULL, '', '', '', ''),
('840821/8027', NULL, 'Jaroslav', NULL, 'Cipak', NULL, 1, NULL, NULL, '', '', '', ''),
('841201/1248', NULL, 'Bohuslav', NULL, 'Biely', NULL, 1, NULL, NULL, '', '', '', ''),
('850130/3695', NULL, 'Marek', NULL, 'Ratroch', NULL, 1, NULL, NULL, '', '', '', ''),
('855122/8569', NULL, 'Erika', NULL, 'Lipovska', NULL, 1, NULL, NULL, '', '', '', ''),
('860103/2238', NULL, 'Rudolf', NULL, 'Kovac', NULL, 1, NULL, NULL, '', '', '', ''),
('860907/1259', NULL, 'Janos', NULL, 'Toth', NULL, 1, NULL, NULL, '', '', '', ''),
('870913/3326', NULL, 'Frantisek', NULL, 'Murgas', NULL, 1, NULL, NULL, '', '', '', ''),
('871124/3578', NULL, 'Lukas', NULL, 'Satrapa', NULL, 1, NULL, NULL, '', '', '', ''),
('871203/5472', NULL, 'Jan', NULL, 'Krnac', NULL, 1, NULL, NULL, '', '', '', ''),
('890310/2145', NULL, 'Juraj', NULL, 'Papun', NULL, 1, NULL, NULL, '', '', '', ''),
('890608/4543', NULL, 'Lubos', NULL, 'Lehotsky', NULL, 1, NULL, NULL, '', '', '', ''),
('896123/5471', NULL, 'Zuzana', NULL, 'Slamova', NULL, 1, NULL, NULL, '', '', '', ''),
('900913/3326', NULL, 'Frantisek', NULL, 'Murgas', NULL, 1, NULL, NULL, '', '', '', ''),
('901130/4454', NULL, 'Zdeno', NULL, 'Svetkovsky', NULL, 1, NULL, NULL, '', '', '', ''),
('911001/3623', NULL, 'Andrej', NULL, 'Janci', NULL, 1, NULL, NULL, '', '', '', ''),
('921225/7452', NULL, 'Rastislav', NULL, 'Kontros', NULL, 1, NULL, NULL, '', '', '', ''),
('961102/1111', NULL, 'Adminus', '', 'Testus', NULL, 1, 5, NULL, '', '', '', ''),
('970112/1111', '', 'Juraj', '', 'Pitel', '', 4, NULL, NULL, '', '', '', '');


INSERT INTO `pracovisko` (`idPracovisko`, `Názov`) VALUES
(1, 'Ostatné'),
(2, 'FPEDS'),
(3, 'StrojF'),
(4, 'FEII'),
(5, 'StavF'),
(6, 'FBI'),
(7, 'FRI'),
(8, 'FHV');


INSERT INTO `pravomoci` (`funkcie_idPozícia`, `Kontakty`, `Kurzy`, `Kariera`, `Blog`, `Pravomoci`, `Zalozky`, `Dokumenty`, `Dotazniky`, `Inzercia`, `Miesta`, `Detail_info`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 0, 0, 1, 0, 0, 0, 0, 1, 1, 1, 0),
(4, 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 1),
(5, 0, 1, 1, 1, 0, 0, 0, 1, 0, 0, 1),
(6, 0, 1, 0, 0, 0, 0, 0, 1, 0, 0, 0),
(7, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1),
(8, 0, 1, 1, 1, 0, 1, 0, 1, 0, 0, 1),
(9, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1),
(10, 0, 1, 1, 1, 0, 1, 0, 1, 0, 0, 1);


INSERT INTO `precitane_blog` (`Blog_idBlog`, `os_udaje_rod_cislo`, `datum`) VALUES
(1, '961102/1111', '0000-00-00'),
(2, '961102/1111', '0000-00-00'),
(3, '961102/1111', '0000-00-00'),
(5, '961102/1111', '0000-00-00');


INSERT INTO `prihlaseny` (`os_udaje_rod_cislo`, `prednasky_idprednasky`) VALUES
('970112/1111', 1);


INSERT INTO `prirad_funkcia` (`zaznam`, `funkcie_idPozícia`, `os_udaje_rod_cislo`, `od`, `do`) VALUES
(1, 1, '961102/1111', '2021-05-04', NULL),
(2, 1, '970112/1111', '2021-05-04', '2021-05-04'),
(3, 2, '970112/1111', '2021-05-04', '2021-05-04'),
(4, 1, '970112/1111', '2021-05-04', '2021-05-04'),
(5, 1, '970112/1111', '2021-05-04', '2021-05-04'),
(6, 2, '970112/1111', '2021-05-04', '2021-05-04'),
(7, 2, '860907/1259', '2021-05-04', NULL),
(9, 2, '840312/7845', '2021-05-04', NULL),
(10, 2, '830514/5341', '2021-05-04', NULL),
(11, 2, '841201/1248', '2021-05-04', NULL),
(12, 2, '850130/3695', '2021-05-04', NULL),
(13, 2, '781015/4431', '2021-05-04', NULL),
(14, 2, '800407/3522', '2021-05-04', NULL),
(15, 2, '791229/5431', '2021-05-04', NULL),
(16, 2, '871124/3578', '2021-05-04', NULL),
(17, 2, '871203/5472', '2021-05-04', NULL),
(18, 2, '890310/2145', '2021-05-04', NULL),
(19, 2, '911001/3623', '2021-05-04', NULL),
(20, 2, '901130/4454', '2021-05-04', NULL),
(21, 2, '921225/7452', '2021-05-04', NULL),
(22, 2, '900913/3326', '2021-05-04', NULL),
(23, 2, '870913/3326', '2021-05-04', NULL),
(24, 2, '890608/4543', '2021-05-04', NULL),
(25, 2, '860103/2238', '2021-05-04', NULL),
(26, 2, '896123/5471', '2021-05-04', NULL),
(27, 2, '855122/8569', '2021-05-04', NULL),
(28, 2, '830914/7748', '2021-05-04', NULL),
(29, 2, '840410/6777', '2021-05-04', NULL),
(30, 2, '840409/7900', '2021-05-04', NULL),
(31, 2, '830420/8088', '2021-05-04', NULL),
(32, 2, '830301/7789', '2021-05-04', NULL),
(33, 2, '831002/8463', '2021-05-04', NULL),
(34, 2, '840307/7485', '2021-05-04', NULL),
(35, 2, '840821/8027', '2021-05-04', NULL),
(36, 2, '830324/7887', '2021-05-04', NULL),
(37, 2, '830703/7486', '2021-05-04', NULL),
(38, 2, '820101/8452', '2021-05-04', NULL),
(39, 2, '840409/7680', '2021-05-04', NULL),
(40, 2, '831204/7766', '2021-05-04', NULL),
(41, 2, '810101/8079', '2021-05-04', NULL),
(41, 3, '970112/1111', '2021-05-04', NULL);


INSERT INTO `projekty` (`idProjekt`, `datum`, `popis`, `verejne`, `Subor_idSubor`, `os_udaje_rod_cislo`) VALUES
(1, '2021-05-04', 'Vývoj strojárskeho priemyslu (dizajn, technológia a riadenie výroby) ako základný základ pre pokrok v oblasti logistiky malých a stredných podnikov - výskum, príprava a realizácia spoločných študijných programov (detail)', 1, 18, '961102/1111'),
(2, '2021-05-04', 'Prevádzka centrálnych informačných systémov. Zabezpečenie prevádzky, rozvoja a údržby centrálnych informačných systémov MŠVVaŠ SR, konkrétne eKEGE, CRŠ, CRZ, portál VŠ (detail)', 1, 19, '961102/1111'),
(3, '2021-05-04', ' Vývoj nových funkcionalít aplikácií pre systém Mobility Online a ich technická podpora a prevádzka, vrátane elearningových programov v rámci koncepcie štátnej politiky starostlivosti o Slovákov žijúcich v zahraničí (detail)', 1, 20, '961102/1111'),
(4, '2021-05-04', ' Výučba a výskum v modernej výrobe (detail)', 1, 21, '961102/1111'),
(5, '2021-05-04', 'Teória horúcej hmoty a relativistických zrážok ťažkých iónov (detail)', 1, 22, '961102/1111'),
(6, '2021-05-04', 'Senzory a inteligencia v zastavanom prostredí (detail)', 0, 23, '961102/1111'),
(7, '2021-05-04', 'Inovatívny systém pre testovanie logistických procesov s využitím počítačovej simulácie a emulácie (detail)', 1, 24, '970112/1111'),
(8, '2021-05-04', 'Metagenomický prístup indentifikácie a charakterizácie vírusových ochorení pri vybratých druhoch liečivých rastlín (detail)', 1, 25, '970112/1111'),
(9, '2021-05-04', 'Výskum a vývoj multikriteriálnej diagnostiky výrobných strojov a zariadení na báze implementácie metód umelej inteligencie (detail)', 0, 26, '970112/1111');

INSERT INTO `prvok` (`idprvok`, `formular_idformular`, `typ_prvku`, `z_index`, `Nazov`, `Popis`, `min`, `max`, `Vyzadovanie`, `Mozn_ine`) VALUES
(1, 1, 12, 1, 'test', 'test', NULL, NULL, NULL, NULL);


INSERT INTO `sprava` (`idSprva`, `text`, `datum`, `Odosielatel`, `konverzacia_idKonverzacie`) VALUES
(1, 'Testujem ci idem', '2021-05-04', '961102/1111', 1),
(2, 'Potvrdzujem že funguješ', '2021-05-04', '970112/1111', 1),
(3, 'Som rád', '2021-05-04', '961102/1111', 1);


INSERT INTO `subor` (`idSubor`, `nazov`, `cesta`, `vytvorenie`, `popis`, `Zalozka_idZalozka`, `inzerat_id_inzerat`) VALUES
(1, 'Životopis v angličtine', '/dokumenty_tlaciva/610648zivotopis en.docx', '2021-05-04', '', '19', NULL),
(2, 'Chronológ', '/dokumenty_tlaciva/387839zivotopis chronolog.docx', '2021-05-04', '', '19', NULL),
(3, 'Šablona', '/dokumenty_tlaciva/846969vzor zivotopisu.dotx', '2021-05-04', '', '19', NULL),
(4, 'Tlačivo', '/dokumenty_tlaciva/381541tlacivo-VUPCH-1.xlsx', '2021-05-04', '', '20', NULL),
(5, '961102/1111', '/user_foto/961102/1111/2191435pexels-photo-771742.webp', '2021-05-04', NULL, NULL, NULL),
(6, '20210504_050505053434_aab5a87213aa27c90372b7ec4eb5786a.webp', '/inzercia/categoria/9316920210504_050505053434_aab5a87213aa27c90372b7ec4eb5786a.webp', '2021-05-04', NULL, NULL, NULL),
(7, '20210504_050505055555_12463468-funny-parcel-service-cartoon.jpg', '/inzercia/categoria/58658320210504_050505055555_12463468-funny-parcel-service-cartoon.jpg', '2021-05-04', NULL, NULL, NULL),
(8, '20210504_050505051919_download.jpg', '/inzercia/categoria/57908020210504_050505051919_download.jpg', '2021-05-04', NULL, NULL, NULL),
(9, 'Hladám odvoz', '/inzercia/961102/1111_1/24083020210504_050505052626_0156099_little-tikes-cozy-coupe-odrazadlo-brendon-156099_600.jpg', '2021-05-04', NULL, NULL, 1),
(10, 'Notebook', '/inzercia/961102/1111_2/86425820210504_050505053131_P1040291.jpg', '2021-05-04', NULL, NULL, 2),
(11, 'Tvorba webstránok', '/inzercia/961102/1111_3/94572620210504_050505052828_download.jpg', '2021-05-04', NULL, NULL, 3),
(14, '', '/pozicia_dokumenty/29986120210504_060605051212_Detail.pdf', '2021-05-04', NULL, NULL, NULL),
(15, '', '/pozicia_dokumenty/78333520210504_060605053939_Detail.pdf', '2021-05-04', NULL, NULL, NULL),
(16, '', '/pozicia_dokumenty/2974820210504_060605055454_Detail.pdf', '2021-05-04', NULL, NULL, NULL),
(17, '', '/pozicia_dokumenty/59386620210504_060605051616_Detail.pdf', '2021-05-04', NULL, NULL, NULL),
(18, '', '/pozicia_dokumenty/59169920210504_060605054444_Detail.pdf', '2021-05-04', NULL, NULL, NULL),
(19, '', '/pozicia_dokumenty/15450120210504_060605050707_Detail.pdf', '2021-05-04', NULL, NULL, NULL),
(20, '', '/pozicia_dokumenty/61675820210504_060605052222_Detail.pdf', '2021-05-04', NULL, NULL, NULL),
(21, '', '/pozicia_dokumenty/38343520210504_060605053434_Detail.pdf', '2021-05-04', NULL, NULL, NULL),
(22, '', '/pozicia_dokumenty/44082020210504_060605054848_Detail.pdf', '2021-05-04', NULL, NULL, NULL),
(23, '', '/pozicia_dokumenty/38334620210504_060605050303_Detail.pdf', '2021-05-04', NULL, NULL, NULL),
(24, '', '/pozicia_dokumenty/44837420210504_060605052929_Detail.pdf', '2021-05-04', NULL, NULL, NULL),
(25, '', '/pozicia_dokumenty/71071320210504_060605054646_Detail.pdf', '2021-05-04', NULL, NULL, NULL),
(26, '', '/pozicia_dokumenty/82584720210504_060605055959_Detail.pdf', '2021-05-04', NULL, NULL, NULL),
(27, 'PHP pre začiatočníkov', '/prednaska_fotky/9223320210504_060605051818_1_Y1hq9sHXG26Fyhys81z8rg.png', '2021-05-04', NULL, NULL, NULL),
(28, 'Javascript', '/prednaska_fotky/6915820210504_060605053333_php-1.jpg', '2021-05-04', NULL, NULL, NULL);

INSERT INTO `zalozka` (`idZalozka`, `Nazov`, `glyphicon`, `link`, `os_udaje_rod_cislo`, `podskupina`) VALUES
('12', 'Zamestnanecký portál', 'glyphicon-signal', 'https://ess.iedu.sk/irj/portal', NULL, 2),
('13', 'Hodnotenie zamestnancov', 'glyphicon-pencil', 'https://hodnotenie.uniza.sk/', NULL, 2),
('14', 'SCOPUS Publikacie', 'glyphicon-asterisk', 'https://www.scopus.com/', NULL, 3),
('15', 'Web of Science', 'glyphicon-asterisk', 'https://login.webofknowledge.com/', NULL, 3),
('16', 'ORCID', 'glyphicon-asterisk', 'https://orcid.org/', NULL, 3),
('17', 'Slovenská akreditačná agentúra', 'glyphicon-asterisk', 'https://saavs.sk/', NULL, 3),
('18', 'Vzorové životopisy', 'glyphicon-asterisk', 'https://www.vzory-zmluv-zadarmo.sk/zivotopisy/', NULL, 3),
('19', 'Vzorové životopisy', 'glyphicon-pencil', NULL, NULL, 0),
('2', 'E-Many', 'glyphicon-credit-card', 'https://emany.uniza.sk', NULL, 2),
('20', 'Tlačivo VUPCH', 'glyphicon-signal', NULL, NULL, 0),
('21', 'SHMU', 'glyphicon-cloud', 'http://www.shmu.sk/sk/?page=1', '961102/1111', 0),
('3', 'Vzdelavanie', 'glyphicon-education', 'http://vzdelavanie.uniza.sk/vzdelavanie/', NULL, 2),
('4', 'IKT-Služby', 'glyphicon-pencil', 'https://helpdesk.uniza.sk/ikt/', NULL, 2),
('5', 'Web Mail', 'glyphicon-envelope', 'https://webmail.stud.uniza.sk/roundcubemail/', NULL, 2),
('6', 'Ubytovanie', 'glyphicon-home', 'https://www.iklub.sk/?q=ubytko', NULL, 2),
('7', 'Úložisko', 'glyphicon-download-alt', 'https://uschovna.uniza.sk/index.php', NULL, 2),
('8', 'Knižnica', 'glyphicon-book', 'http://ukzu.uniza.sk/en/elementor-171/', NULL, 2),
('9', 'Stravovanie', 'glyphicon-cutlery', 'https://strava.uniza.sk/WebKredit/', NULL, 2);


