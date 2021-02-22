-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: Po 22.Feb 2021, 17:32
-- Verzia serveru: 10.4.8-MariaDB
-- Verzia PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `mydb`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `blog`
--

CREATE TABLE `blog` (
  `idBlog` int(11) NOT NULL,
  `aktualita` tinyint(4) NOT NULL,
  `verejne` tinyint(4) NOT NULL,
  `nadpis` varchar(255) NOT NULL,
  `predtext` longtext NOT NULL,
  `text` longtext NOT NULL,
  `datum` date NOT NULL,
  `Uzivatel_idUzivatel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `blog`
--

INSERT INTO `blog` (`idBlog`, `aktualita`, `verejne`, `nadpis`, `predtext`, `text`, `datum`, `Uzivatel_idUzivatel`) VALUES
(1, 0, 0, 'Výzva na predkladanie žiadostí o štipendiá fr', 'Radi by sme Vás informovali o možnosti získať štipendium francúzskej vlády na druhý rok magisterského štúdia (Master 2).\r\n\r\nO štipendium sa môžu uchádzať slovenskí študenti štvrtého alebo piateho ročníka.\r\nVýška štipendia = 700 eur mesačne.\r\nŠtipendisti francúzskej vlády neplatia zápisné na francúzskych univerzitách (verejných školách).\r\nNa nižšie ročníky je možné získať len kofinancované štipendium (350 eur mesačne).', '', '2021-01-08', 1),
(2, 0, 1, 'Príkaz rektora č. 1/2021 na dodržiavanie prev', 'Rektor Žilinskej univerzity v Žiline (ďalej len UNIZA) za účelom zníženia rizika šírenia koronavírusu a choroby COVID-19 na UNIZA v rámci implementácie uznesenia vlády SR č. 808 zo dňa 31.12.2020 a vyhlášok Úradu verejného zdravotníctva SR vydáva príkaz rektora č. 1/2021.', '', '2021-01-04', 1),
(3, 1, 1, 'Vyhlásenie slovenských vedeckých inštitúcií: Dôverujme vedcom a vedkyniam!', 'My, podpísaní predstavitelia špičkových vedeckých inštitúcií, sme už od vypuknutia pandémie hrdí na slovenské vedkyne a vedcov a v rámci svojich možností im poskytujeme mimoriadnu podporu. V náročných podmienkach odvádzajú špičkovú prácu, ktorá celej spoločnosti pomáha v boji s výzvami tejto doby. Naše vedecké pracoviská produkujú výstupy porovnateľné s tými najlepšími svetovými expertnými centrami – od hľadania lacných alternatív k systémom pľúcnej ventilácie cez vylepšovanie testov PCR po sekvenovanie genetickej informácie nového koronavírusu. V ťažkých časoch nám nepomôžu emotívne vyjadrenia, ale len poctivá, na dôkazoch založená, expertíza.', 'Dunning-Krugerov efekt ukazuje, že ľudia s minimálnymi znalosťami v určitej oblasti sa často cítia ako najväčší experti. S postupným zvyšovaním expertízy a rozširovaním znalostí táto sebaistota klesá. U skutočných odborníkov začne po čase stúpať – ale nikdy nedosiahne úrovne suverénneho laika. Väčšina skutočných odborníkov sa vyznačuje pokorou a tendenciou hľadať na každé tvrdenie empirické dôkazy.\r\n\r\nV časoch, keď sa okrem vírusu rýchlo šíria aj nebezpečné dezinformácie, by sme mali viac než kedykoľvek doteraz klásť dôraz na odbornú diskusiu, vecnú argumentáciu a kritické myslenie. Preto vyzývame všetkých, aby sa v tejto náročnej dobe priklonili na stranu racionality a verili tým, ktorí si svojimi skúsenosťami, odbornosťou, dlhoročnou prácou, spoliehaním sa na empirické dôkazy a disciplinovaným kritickým myslením zaslúžia status expertov. Počúvajme ich argumenty, aj keď nám ich slová niekedy možno nezapadajú do myšlienkových schém. Situácia je príliš vážna na to, aby sme expertízu znevažovali.', '2021-01-15', 1),
(4, 1, 0, 'Veľtrh práce pre študentov a absolventov', 'Ponúkame Vám možnosť účasti na Veľtrhu práce pre študentov a absolventov VŠ JobChallenge, ktorý organizuje naše partnerské Kariérne centrum Masarykovej univerzity. Veľtrh tento rok bude realizovaný online a tak sa môžete prihlásiť aj vy. Registrácia na veľtrh je zadarmo. Sprievodnými podujatiami sú workshopy a talk show so zamestnávateľmi.', 'Veľtrh práce pre študentov a absolventov VŠ JobChallenge', '2021-01-12', 1);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `kariera`
--

CREATE TABLE `kariera` (
  `idKariera` int(11) NOT NULL,
  `datum` date NOT NULL,
  `popis` varchar(45) NOT NULL,
  `pdf` text DEFAULT NULL,
  `Pracovisko_idPracovisko` int(11) NOT NULL,
  `Uzivatel_idUzivatel` int(11) NOT NULL,
  `verejne` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `kariera`
--

INSERT INTO `kariera` (`idKariera`, `datum`, `popis`, `pdf`, `Pracovisko_idPracovisko`, `Uzivatel_idUzivatel`, `verejne`) VALUES
(1, '2021-01-19', 'Výberové konanie FPEDAS KCMD ', 'https://www.uniza.sk/images/pdf/uradna-tabula/pracovne-miesta-vyberove-konanie/2021/19012021_VK-FPEDAS-KCMD-docent-dopravne-sluzby.pdf', 2, 1, 1),
(2, '2021-01-18', 'Výberové konanie FRI KMME - vedúci katedry', 'https://www.uniza.sk/images/pdf/uradna-tabula/pracovne-miesta-vyberove-konanie/2021/18012021_VK-FRI-KMME-veduci-katedry.pdf', 3, 1, 0);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `konverzacia`
--

CREATE TABLE `konverzacia` (
  `precitane` tinyint(4) NOT NULL,
  `Uzivatel_idUzivatel1` int(11) NOT NULL,
  `Uzivatel_idUzivatel2` int(11) NOT NULL,
  `idKonverzacie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `konverzacia`
--

INSERT INTO `konverzacia` (`precitane`, `Uzivatel_idUzivatel1`, `Uzivatel_idUzivatel2`, `idKonverzacie`) VALUES
(1, 1, 2, 1),
(1, 1, 4, 2);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `login`
--

CREATE TABLE `login` (
  `idLogin` int(11) NOT NULL,
  `Login` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `telefon` varchar(13) NOT NULL,
  `miestnost` varchar(45) NOT NULL,
  `Pozícia_idPozícia` int(11) NOT NULL,
  `Pracovisko_idPracovisko` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `login`
--

INSERT INTO `login` (`idLogin`, `Login`, `password`, `telefon`, `miestnost`, `Pozícia_idPozícia`, `Pracovisko_idPracovisko`) VALUES
(1, 'admin', 'teE9Uy5Yab.bo', '+421907100100', 'virtual', 1, 1),
(2, 'nimda', 'teE9Uy5Yab.bo', '+421909909909', 'virtual', 1, 2),
(3, 'janosik', 'teE9Uy5Yab.bo', '', 'virtual', 1, 3);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `notifikacia`
--

CREATE TABLE `notifikacia` (
  `idNotifikacia` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  `datum` date DEFAULT NULL,
  `Uzivatel_idUzivatel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `os_udaje`
--

CREATE TABLE `os_udaje` (
  `idOS_udaje` int(11) NOT NULL,
  `Meno` varchar(45) NOT NULL,
  `Priezvisko` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `telefon` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `os_udaje`
--

INSERT INTO `os_udaje` (`idOS_udaje`, `Meno`, `Priezvisko`, `email`, `telefon`) VALUES
(1, 'Adminus', 'Technikus', NULL, NULL),
(2, 'Ferko', 'Janko', NULL, NULL),
(3, 'Janko', 'Hrasko', '', ''),
(4, 'Juraj', 'Janošík', NULL, NULL);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `pozícia`
--

CREATE TABLE `pozícia` (
  `idPozícia` int(11) NOT NULL,
  `Kontakty` tinyint(4) NOT NULL,
  `Kurzy` tinyint(4) NOT NULL,
  `Kariera` tinyint(4) NOT NULL,
  `Blog` tinyint(4) NOT NULL,
  `Pravomoci` tinyint(4) NOT NULL,
  `Nazov` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `pozícia`
--

INSERT INTO `pozícia` (`idPozícia`, `Kontakty`, `Kurzy`, `Kariera`, `Blog`, `Pravomoci`, `Nazov`) VALUES
(1, 1, 1, 1, 1, 1, 'admin');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `pracovisko`
--

CREATE TABLE `pracovisko` (
  `idPracovisko` int(11) NOT NULL,
  `Názov` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `pracovisko`
--

INSERT INTO `pracovisko` (`idPracovisko`, `Názov`) VALUES
(1, 'ostatne'),
(2, 'Fakulta prevádzky a ekonomiky dopravy a spojov'),
(3, 'Fakulta riadenia a informatiky');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `precitane_blog`
--

CREATE TABLE `precitane_blog` (
  `Uzivatel_idUzivatel` int(11) NOT NULL,
  `Blog_idBlog` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `precitane_blog`
--

INSERT INTO `precitane_blog` (`Uzivatel_idUzivatel`, `Blog_idBlog`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 1),
(2, 3),
(2, 4),
(2, 2);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `prednasky`
--

CREATE TABLE `prednasky` (
  `idprednasky` int(11) NOT NULL,
  `datum` date NOT NULL,
  `nazov` varchar(45) NOT NULL,
  `popis` longtext DEFAULT NULL,
  `miesto` varchar(255) NOT NULL,
  `cena` double DEFAULT NULL,
  `picture_url` text DEFAULT NULL,
  `Uzivatel_idUzivatel` int(11) NOT NULL,
  `verejne` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `prednasky`
--

INSERT INTO `prednasky` (`idprednasky`, `datum`, `nazov`, `popis`, `miesto`, `cena`, `picture_url`, `Uzivatel_idUzivatel`, `verejne`) VALUES
(1, '2021-01-19', 'Firemné kurzy pre zamestnancov', 'kurzy/školenia VaV sú osvedčené - realizujeme ich na základe našich dlhoročných skúseností o čom svedčí aj spokojnosť vyše 42 tisíc klientov', 'UNIZA', 0, 'http://www.rockandsnow.sk/wp-content/uploads/2016/12/rockandsnow-lavinovy_kurz_01.jpg', 1, 0),
(2, '2021-01-12', 'Big Data', 'Veľké dáta sú k nám však bližšie ako sa nám zdá. Najznámejšou aplikáciou spracúvajúcou veľké dáta je vyhľadávač Google (ale tiež Bing a Yahoo! a ďalšie). Ďalšími notoricky známymi spoločnosťami, kde big data hrajú kľúčovú úlohu sú Facebook, Amazon, eBay, Tesco a mnohé ďalšie.', 'Uniza', 0, 'https://a-static.projektn.sk/2015/10/tumblr_n6cjaup9mg1td9006o1_1280.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `prihlaseny`
--

CREATE TABLE `prihlaseny` (
  `prednasky_idprednasky` int(11) NOT NULL,
  `Uzivatel_idUzivatel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `sprava`
--

CREATE TABLE `sprava` (
  `idSprva` int(11) NOT NULL,
  `text` varchar(1024) NOT NULL,
  `datum` date NOT NULL,
  `konverzacia_idKonverzacie` int(11) NOT NULL,
  `Uzivatel_idUzivatel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `sprava`
--

INSERT INTO `sprava` (`idSprva`, `text`, `datum`, `konverzacia_idKonverzacie`, `Uzivatel_idUzivatel`) VALUES
(1, 'Som test', '2021-01-22', 1, 1),
(2, 'Ja viem', '2021-01-22', 1, 2),
(3, 'ano', '2021-01-25', 1, 1),
(4, 'ano', '2021-01-25', 2, 1),
(5, 'test2', '2021-02-02', 2, 1),
(6, 'test3', '2021-02-02', 2, 1),
(7, 'test', '2021-02-11', 2, 4),
(8, 'ahoj', '2021-02-22', 1, 1),
(9, 'ahoj', '2021-02-22', 1, 1),
(10, 'ahoj', '2021-02-22', 1, 2),
(11, 'test', '2021-02-22', 1, 1),
(12, 'ahoj', '2021-02-22', 1, 2),
(13, 'test', '2021-02-22', 1, 2);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `uzivatel`
--

CREATE TABLE `uzivatel` (
  `idUzivatel` int(11) NOT NULL,
  `Login_idLogin` int(11) DEFAULT NULL,
  `OS_udaje_idOS_udaje` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `uzivatel`
--

INSERT INTO `uzivatel` (`idUzivatel`, `Login_idLogin`, `OS_udaje_idOS_udaje`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, NULL, 3),
(4, 3, 4);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `zalozka`
--

CREATE TABLE `zalozka` (
  `idZalozka` varchar(45) NOT NULL,
  `Nazov` varchar(45) NOT NULL,
  `link` varchar(1024) NOT NULL,
  `glyphicon` varchar(45) DEFAULT NULL,
  `Uzivatel_idUzivatel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `zalozka`
--

INSERT INTO `zalozka` (`idZalozka`, `Nazov`, `link`, `glyphicon`, `Uzivatel_idUzivatel`) VALUES
('1', 'Google', 'https://www.google.com/', 'glyphicon-search', 1),
('10', 'yest', 'http://localhost/PHPprojectForlder/Web_Zamestnanecky_portal/HTML/System.php#', 'glyphicon-plus', 1),
('2', 'E-Many', 'https://emany.uniza.sk', 'glyphicon-credit-card', NULL),
('3', 'Vzdelavanie', 'http://vzdelavanie.uniza.sk/vzdelavanie/', 'glyphicon-education', NULL),
('4', 'IKT-Služby', 'https://helpdesk.uniza.sk/ikt/', 'glyphicon-pencil', NULL),
('5', 'Mail', 'https://webmail.stud.uniza.sk/roundcubemail/', 'glyphicon-envelope', NULL),
('6', 'Ubytovanie', 'https://www.iklub.sk/?q=ubytko', 'glyphicon-home', NULL),
('7', 'Uložiško', 'https://uschovna.uniza.sk/index.php', 'glyphicon-download-alt', NULL),
('8', 'Knižnica', 'http://ukzu.uniza.sk/en/elementor-171/', 'glyphicon-book', NULL),
('9', 'Stravovanie', 'https://strava.uniza.sk/WebKredit/', 'glyphicon-cutlery', NULL);

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`idBlog`);

--
-- Indexy pre tabuľku `kariera`
--
ALTER TABLE `kariera`
  ADD PRIMARY KEY (`idKariera`);

--
-- Indexy pre tabuľku `konverzacia`
--
ALTER TABLE `konverzacia`
  ADD PRIMARY KEY (`idKonverzacie`);

--
-- Indexy pre tabuľku `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`idLogin`);

--
-- Indexy pre tabuľku `notifikacia`
--
ALTER TABLE `notifikacia`
  ADD PRIMARY KEY (`idNotifikacia`);

--
-- Indexy pre tabuľku `os_udaje`
--
ALTER TABLE `os_udaje`
  ADD PRIMARY KEY (`idOS_udaje`);

--
-- Indexy pre tabuľku `pozícia`
--
ALTER TABLE `pozícia`
  ADD PRIMARY KEY (`idPozícia`);

--
-- Indexy pre tabuľku `pracovisko`
--
ALTER TABLE `pracovisko`
  ADD PRIMARY KEY (`idPracovisko`);

--
-- Indexy pre tabuľku `precitane_blog`
--
ALTER TABLE `precitane_blog`
  ADD KEY `fk_precitane_blog_Uzivatel1` (`Uzivatel_idUzivatel`),
  ADD KEY `fk_precitane_blog_Blog1` (`Blog_idBlog`);

--
-- Indexy pre tabuľku `prednasky`
--
ALTER TABLE `prednasky`
  ADD PRIMARY KEY (`idprednasky`);

--
-- Indexy pre tabuľku `sprava`
--
ALTER TABLE `sprava`
  ADD PRIMARY KEY (`idSprva`);

--
-- Indexy pre tabuľku `uzivatel`
--
ALTER TABLE `uzivatel`
  ADD PRIMARY KEY (`idUzivatel`);

--
-- Indexy pre tabuľku `zalozka`
--
ALTER TABLE `zalozka`
  ADD PRIMARY KEY (`idZalozka`),
  ADD KEY `Uzivatel_idUzivatel` (`Uzivatel_idUzivatel`);

--
-- Obmedzenie pre exportované tabuľky
--

--
-- Obmedzenie pre tabuľku `precitane_blog`
--
ALTER TABLE `precitane_blog`
  ADD CONSTRAINT `fk_precitane_blog_Blog1` FOREIGN KEY (`Blog_idBlog`) REFERENCES `blog` (`idBlog`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_precitane_blog_Uzivatel1` FOREIGN KEY (`Uzivatel_idUzivatel`) REFERENCES `uzivatel` (`idUzivatel`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Obmedzenie pre tabuľku `zalozka`
--
ALTER TABLE `zalozka`
  ADD CONSTRAINT `zalozka_ibfk_1` FOREIGN KEY (`Uzivatel_idUzivatel`) REFERENCES `uzivatel` (`idUzivatel`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
