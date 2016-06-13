-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas generowania: 14 Cze 2016, 01:42
-- Wersja serwera: 5.5.49-0+deb8u1
-- Wersja PHP: 5.6.20-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `recrutify`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
`answer_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `content` mediumtext CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `correct` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=288 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `answers`
--

INSERT INTO `answers` (`answer_id`, `question_id`, `content`, `correct`) VALUES
(1, 1, 'Połączenie wierszy tabeli 1 z wszystkimi wierszami tabeli 2', 1),
(2, 1, 'Zwraca iloczyn wszystkich wartosci liczbowych tabeli 1 i tabeli 2', 0),
(3, 1, 'Połączenie wierszy tabeli 1 z wierszami tabeli 2 za pomocą kluczy głównych', 0),
(4, 2, 'Tworzone oprogramowanie powinno być otwarte na modyfikacje, a zamkniete na zmiany', 0),
(5, 2, 'Tworzone oprogramowanie powinno być otwarte na zmiany, a zamkniete na modyfikacje', 1),
(6, 2, 'Klasy otwarte na modyfikacje powinny być abstract, klasy zamknięte na modyfikacje powiny być final', 0),
(7, 2, 'Open/closed principle', 1),
(8, 2, 'Open for changes principle', 0),
(9, 5, 'Length', 0),
(10, 5, 'Size', 0),
(11, 5, 'Count', 1),
(12, 6, 'At school', 1),
(13, 6, 'In the evenings', 1),
(14, 6, 'In the library', 1),
(15, 7, 'Opinion', 1),
(16, 7, 'Advice', 1),
(17, 7, 'Knowledge', 1),
(18, 7, 'Information', 1),
(19, 8, 'Habit', 1),
(20, 8, 'Custom way', 1),
(21, 8, 'System', 1),
(22, 9, 'Dzieki testom automatycznym łatwiej można uniknąć testowania wyczerpującego', 0),
(23, 9, 'Przy użyciu odpowiednich narzędzi testowanie wyczerpujące możemy zastosować dla każdego oprogramowania', 0),
(24, 9, 'Jest niemożliwe aby przetestować wszystkie kombinacje we/wy', 1),
(25, 10, 'Testowanie w którym tester pełni rolę użytkownika końcowego', 1),
(28, 10, 'Testowanie, w którym staramy się pokryć wszystkie przypadki', 0),
(29, 10, 'Testowanie polegające na jak najlepszym przygotowaniu narzędzia, które wykona scenariusz i oceni rezultaty', 0),
(30, 11, 'Testowanie w którym tester pełni rolę użytkownika końcowego ', 0),
(31, 11, 'Testowanie, w którym staramy się pokryć wszystkie ', 0),
(32, 11, 'Testowanie polegające na jak najlepszym przygotowaniu narzędzia, które wykona scenariusz i oceni rezultaty', 1),
(33, 12, 'Testowanie w którym tester pełni rolę użytkownika końcowego ', 0),
(34, 12, 'Testowanie, w którym staramy się pokryć wszystkie przypadki', 1),
(35, 12, 'Testowanie polegające na jak najlepszym przygotowaniu narzędzia, które wykona scenariusz i oceni rezultaty', 0),
(36, 13, 'JIRA', 1),
(37, 13, 'Visual Studio', 0),
(38, 13, 'Warta XXI', 0),
(39, 14, 'Definiowanie celów testów', 0),
(40, 14, 'Przegląd podstaw testów', 1),
(41, 14, 'Tworzenie test suites z procedur testowych', 0),
(42, 14, 'Analiza i nauka w celu poprawiania procesu testowania', 0),
(43, 15, 'Produkt „wysypuje się” kiedy użytkownik zaznaczy opcję a okienku dialogowym', 1),
(44, 15, 'Jeden plik źródłowy jest nieaktualny', 0),
(45, 15, 'Deweloper źle zinterpretował wymagania dotyczące algorytmu', 0),
(46, 16, 'Testowanie poprawionych defektów podczas wprowadzania nowego systemu', 0),
(47, 16, 'Testowanie rozszerzeń do istniejącego systemu', 1),
(48, 16, 'Obsługiwanie zażaleń do systemu podczas testów akceptacyjnych', 0),
(49, 16, 'Integrowanie funkcji podczas tworzenia nowego systemu', 0),
(50, 4, 'Open/closed principle', 1),
(51, 4, 'Open for changes principle', 0),
(52, 3, 'UTP', 0),
(53, 3, 'FTP', 0),
(54, 3, 'TTP', 1),
(55, 3, 'STP', 0),
(56, 17, 'Przepustowość', 0),
(57, 17, 'Cena', 1),
(58, 17, 'Masa i wymiary', 0),
(59, 17, 'Niewrażliwość na zakłócenia', 0),
(60, 18, 'Cienki kabel koncentryczny', 0),
(61, 18, 'Gruby kabel koncentryczny', 0),
(62, 18, 'Skrętka', 0),
(63, 18, 'Światłowód', 1),
(64, 19, 'Przepustowość', 1),
(65, 19, 'Średnia', 0),
(66, 19, 'Długość', 0),
(67, 20, 'Magistrala', 0),
(68, 20, 'Pierścień', 0),
(69, 20, 'Gwiazda', 1),
(70, 21, 'Łatwa instalacja', 1),
(71, 21, 'Nieograniczona długość kabla', 0),
(72, 21, 'Niski koszt', 0),
(73, 22, '1', 0),
(74, 22, '2', 1),
(75, 22, '3', 0),
(76, 22, '4', 0),
(77, 23, '1', 1),
(78, 23, '2', 0),
(79, 23, '3', 0),
(80, 23, '4', 0),
(81, 24, 'MAC', 1),
(82, 24, 'IPv4', 0),
(83, 24, 'IPv6', 0),
(84, 25, 'Sieciowa, transportu, aplikacji, prezentacji danych, sesji, łącza transmisyjnego, fizyczna', 0),
(85, 25, 'Fizyczna, łącza transmisyjnego, transportu, sieciowa, sesji, prezentacji danych, aplikacji', 1),
(86, 25, 'Fizyczna, łącza transmisyjnego, sieciowa, transportu, prezentacji danych, sesji, aplikacji', 0),
(87, 25, 'Fizyczna, łącza transmisyjnego, sieciowa, transportu, sesji, prezentacji danych, aplikacji', 0),
(88, 26, 'Sieciowa', 0),
(89, 26, 'Transportowa', 0),
(90, 26, 'Aplikacji', 0),
(91, 26, 'Łącza transmisyjnego', 1),
(92, 27, 'Aplikacji', 0),
(93, 27, 'Prezentacji danych', 1),
(94, 27, 'Fizyczna', 0),
(95, 27, 'Transportu', 0),
(96, 28, '170.1.10.0', 1),
(97, 28, '10.255.255.255', 0),
(98, 28, '1.0.0.0', 0),
(99, 29, 'od 10.0.0.0 do 10.255.255.255', 1),
(100, 29, 'od 171.16.0.0 do 172.16.255.255', 0),
(101, 29, 'od 192.168.0.0 do 192.169.255.255', 0),
(102, 30, 'Finger', 0),
(103, 30, 'RFC', 1),
(104, 30, 'Gopher', 0),
(105, 30, 'SSH', 0),
(106, 31, 'Tak', 1),
(107, 31, 'Nie', 0),
(108, 31, 'Tylko wtedy jak interfejsy rozszerzają jeden wspólny interfejs', 0),
(109, 32, 'Rzucając wyjątek', 1),
(110, 32, 'Używając goto', 0),
(111, 32, 'Używając continue', 0),
(112, 33, 'HashSet', 0),
(113, 33, 'TreeSet', 1),
(114, 33, 'LinkedHashSet', 0),
(115, 34, 'Tak', 0),
(116, 34, 'Nie', 1),
(117, 35, 'Length', 0),
(118, 35, 'Size', 0),
(119, 35, 'Count', 1),
(120, 36, 'Bierze wszystkie wyniki z tabeli 1 i dołącza wyniki z tabeli 2, a jeśli ich brakuje dołącza NULL', 0),
(121, 36, 'Bierze wszystkie wyniki z tabeli 2 i dołącza wyniki z tabeli 1, a jeśli ich brakuje dołącza NULL', 1),
(122, 36, 'Bierze wszystkie wyniki z tabeli 2 i dołącza wyniki z tabeli 1, które są NULL', 0),
(123, 36, 'Bierze wszystkie wyniki z tabeli 1 i dołącza wyniki z tabeli 2, które są NULL', 0),
(124, 37, 'Self.method()', 0),
(125, 37, 'Super.method()', 1),
(126, 37, 'This.method()', 0),
(127, 38, 'Połączenie wierszy tabeli 1 z wszystkimi wierszami tabeli 2', 1),
(128, 38, 'Zwraca iloczyn wszystkich wartosci liczbowych tabeli 1 i tabeli 2', 0),
(129, 38, 'Połączenie wierszy tabeli 1 z wierszami tabeli 2 za pomocą kluczy głównych', 0),
(130, 39, 'Tak', 1),
(131, 39, 'Nie', 0),
(132, 39, 'Nie, chyba że zostanie umieszczony w funkcji, która zostanie wywołana w bloku catch', 0),
(133, 40, 'Jest tworzony tylko wtedy kiedy zostanie jawnie zdefiniowany w kodzie', 0),
(134, 40, 'Jest tworzony jeśli nie zdefiniowano jawnie konstruktora w klasie', 1),
(135, 40, 'Konstruktor zdefiniowany ze słowem kluczowym default', 0),
(136, 41, 'Nie powinno się ich już stosować, zastępują je interfejsy', 0),
(137, 41, 'Aby zawierała wspólne zachowanie dla klas z niej dziedziczących', 1),
(138, 41, 'Stosujemy ją kiedy chcemy stworzyć klasę nie mającą znaczenia biznesowego, dopiero klasy dziedziczące nadają znaczenie', 0),
(139, 42, 'Zawiera zmienne lokalne i stos wywołań', 0),
(140, 42, 'Zawiera instancje obiektów i stos wywołań', 1),
(141, 42, 'Zawiera instancje obiektów', 0),
(142, 43, 'Zdefiniowaną w dowolnym bloku kodu', 0),
(143, 43, 'Zdefiniowaną w klasie', 1),
(144, 43, 'Posiadającą metodę getNazwa i setNazwa', 0),
(145, 44, 'Mówi, że klasy mogą dziedziczyć z wielu innych klas', 0),
(146, 44, 'Cecha dzięki której jeden interfejs może być stosowany do wykonania różnych zadań', 0),
(147, 44, 'Oznacza, że dany obiekt może całkowicie zmienić swoje zachowanie w klasie dziedziczącej', 1),
(148, 45, 'Comparable', 1),
(149, 45, 'Equals', 0),
(150, 45, 'CompareTo', 0),
(151, 46, 'Dependency inversion principle', 1),
(152, 46, 'Dependency injection rule', 0),
(153, 46, 'Derived resposibility principle', 0),
(154, 47, 'Abstrakcyjne typy danych', 0),
(155, 47, 'Dynamiczne wiązanie wywołań metod z metodami', 0),
(156, 47, 'Dziedziczenie', 0),
(157, 47, 'Podprogramy rodzajowe', 1),
(158, 48, 'Klasy', 0),
(159, 48, 'Obiekty złożone z par: nazwa własności i wartość', 1),
(160, 48, 'Operator New', 0),
(161, 48, 'Zmienne', 0),
(162, 49, 'C++', 1),
(163, 49, 'C#', 0),
(164, 49, 'Java', 0),
(165, 49, 'We wszyskich powyższych', 0),
(166, 50, 'Open/closed principle', 1),
(167, 50, 'Open for changes principle', 0),
(168, 51, 'Dodawania synchronized na klasie, ponieważ bolokowany jest cały kod w tej klasie', 0),
(169, 51, 'Zagnieżdżania bloków, które są synchronized', 1),
(170, 51, 'Używania synchronized na zmiennych, które nie są final', 0),
(171, 52, 'Single responsibility principle', 1),
(172, 52, 'Solid code rule', 0),
(173, 52, 'Substituted open principle', 0),
(174, 53, 'Substituted open principle', 1),
(175, 53, 'Low coupled principle', 0),
(176, 53, 'Lisp substitution principle', 0),
(177, 54, 'Kiedy wywołamy metodę finalize() na obiekcie', 0),
(178, 54, 'Kiedy nie ma już żadnych referencji do danego obiektu', 1),
(179, 55, 'Interface segregation principle', 1),
(180, 55, 'Inheritance with resposibility rule', 0),
(181, 55, 'Inependent responsibility rule', 0),
(182, 56, 'Waiting', 1),
(183, 56, 'Blocked', 0),
(184, 56, 'Running', 0),
(185, 56, 'Terminated', 0),
(186, 57, 'Tworzone oprogramowanie powinno być otwarte na modyfikacje, a zamkniete na zmiany', 0),
(187, 57, 'Tworzone oprogramowanie powinno być otwarte na zmiany, a zamkniete na modyfikacje', 1),
(188, 57, 'Klasy otwarte na modyfikacje powinny być abstract, klasy zamknięte na modyfikacje powiny być final', 0),
(189, 58, 'Oznacza że algorytm jest złożony dla n elementów', 0),
(190, 58, 'Oznacza złożoność liniową', 0),
(191, 58, 'Oznacza że gdy jest n elementów złożoność wynosi O', 1),
(192, 59, 'Klasa dziedzicząca z klasy bazowej nie powinna całkowicie zmieniać działania metod klasy bazowej, a jedynie rozszerzać jej funkcjonalność', 0),
(193, 59, 'Metody w klasie dziedziczącej nie powinny nadpisywać metod klasy bazowej - powinny być tworzone nowe metody wywołujące metody z klasy bazowej', 0),
(194, 59, 'Klasa dziedzicząca z klasy bazowej może całkowicie zmieniać zasadę działania metod klasy bazowej, jeśli będzie zwracać tą samą wartość co klasa bazowa', 1),
(195, 60, '1', 1),
(196, 60, '2', 0),
(197, 60, '9', 0),
(198, 61, 'Orkiestracji', 0),
(199, 61, 'Deprawacji', 1),
(200, 61, 'Choreografii', 0),
(201, 62, 'Anulowanie', 0),
(202, 62, 'Kompensacja', 0),
(203, 62, 'Skrypt', 1),
(204, 63, 'XOR', 0),
(205, 63, 'FORK', 0),
(206, 63, 'XNOR', 1),
(207, 64, 'Zwinnej', 1),
(208, 64, 'Tradycyjnej', 0),
(209, 65, 'Zwinnej', 1),
(210, 65, 'Tradycyjnej', 0),
(211, 66, 'Zwinnej', 0),
(212, 66, 'Tradycyjnej', 1),
(213, 67, 'Zwinnej', 0),
(214, 67, 'Tradycyjnej', 1),
(215, 68, 'Okrąg z nazwą poniżej', 1),
(216, 68, 'Punktowany owal z nazwą w środku', 0),
(217, 68, 'Prostokątny box z nazwą w środku', 0),
(218, 68, 'Punktowany okrąg z nazwą w środku', 0),
(219, 69, 'Linię z pełnym diamentem na jednym końcu', 0),
(220, 69, 'Linię z pustym diamentem na jednym końcu', 1),
(221, 69, 'Linię ze strzałką na jednym końcu', 0),
(222, 69, 'Linię bez strzałki', 0),
(223, 70, 'Linię z pełnym diamentem na końcu', 0),
(224, 70, 'Linię z pustym diamentem na końcu', 0),
(225, 70, 'Linię z pustym trójkątem na jednym końcu', 1),
(226, 70, 'Linię z pełnym trójkątem na obu końcach', 0),
(227, 71, 'Komponentów', 0),
(228, 71, 'Wdrażania', 1),
(229, 71, 'Klas', 0),
(230, 71, 'Aktywności', 0),
(231, 72, 'At school', 0),
(232, 72, 'In the evenings', 1),
(233, 72, 'In the library', 0),
(234, 73, 'Opinion', 0),
(235, 73, 'Advice', 0),
(236, 73, 'Knowledge', 1),
(237, 73, 'Information', 0),
(238, 74, 'Habit', 0),
(239, 74, 'Custom', 0),
(240, 74, 'Way', 1),
(241, 74, 'System', 0),
(242, 75, 'At school', 0),
(243, 75, 'In the evenings', 1),
(244, 75, 'In the library', 0),
(245, 76, 'Opinion', 0),
(246, 76, 'Advice', 0),
(247, 76, 'Knowledge', 1),
(248, 76, 'Information', 0),
(249, 77, 'Habit', 0),
(250, 77, 'Custom', 0),
(251, 77, 'Way', 1),
(252, 77, 'System', 0),
(253, 78, 'Mówi, że klasy mogą dziedziczyć z wielu innych klas', 0),
(254, 78, 'Cecha dzięki której jeden interfejs może być stosowany do wykonania różnych zadań', 0),
(255, 78, 'Oznacza, że dany obiekt może całkowicie zmienić swoje zachowanie w klasie dziedziczącej', 1),
(256, 79, 'Abstrakcyjne typy danych', 0),
(257, 79, 'Dynamiczne wiązanie wywołań metod z metodami', 0),
(258, 79, 'Dziedziczenie', 0),
(259, 79, 'Podprogramy rodzajowe', 1),
(260, 80, 'C++', 1),
(261, 80, 'C#', 0),
(262, 80, 'Java', 0),
(263, 80, 'We wszystkich powyższych', 0),
(264, 81, 'Open/closed principle', 1),
(265, 81, 'Open for changes principle', 0),
(266, 81, 'Open principle', 0),
(267, 82, 'Oznacza że algorytm jest złożony dla n elementów', 0),
(268, 82, 'Oznacza złożoność liniową', 0),
(269, 82, 'Oznacza że gdy jest n elementów złożoność wynosi O', 1),
(270, 83, 'Tworzone oprogramowanie powinno być otwarte na modyfikacje, a zamkniete na zmiany', 0),
(271, 83, 'Tworzone oprogramowanie powinno być otwarte na zmiany, a zamkniete na modyfikacje', 1),
(272, 83, 'Klasy otwarte na modyfikacje powinny być abstract, klasy zamknięte na modyfikacje', 0),
(273, 84, 'JavaScript', 1),
(274, 84, 'PHP', 0),
(275, 84, 'Prolog', 0),
(276, 85, 'Organizacji działań', 0),
(277, 85, 'Wywiadu u klienta', 1),
(278, 85, 'Zmotywowania pracowników', 0),
(279, 86, 'Motywowanie pracowników, organizacja działań, monitorowanie jakości', 0),
(280, 86, 'Organizacja działań, motywowanie pracowników, monitorowanie jakości', 0),
(281, 86, 'Powinny one trwać równocześnie przez cały czas trwania projektu', 1),
(282, 87, 'Powinien ufać swoim pracownikom', 0),
(283, 87, 'Powinien zatrudnić do tego dodatkową osobę', 0),
(284, 87, 'Powinien „podejrzewać” pracowników o umyślne wprowadzanie błędów', 1),
(285, 88, 'Nastawienie ich przeciwko sobie', 0),
(286, 88, 'Zwiększenie konkurencji między nimi', 0),
(287, 88, 'Lepszą motywację', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
`category_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `description` varchar(256) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `description`) VALUES
(1, 'Tester', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam a sapien mauris. Suspendisse potenti. Aliquam commodo mi ut ultricies tristique. Donec cursus quis felis vitae ultricies.'),
(2, 'Sieciowiec', 'Integer lacinia neque fermentum, sollicitudin tellus et, laoreet tellus. Nullam rhoncus porttitor ultricies. Mauris eget feugiat ipsum. Donec posuere luctus elementum.'),
(3, 'Programista', 'Sed commodo, diam id tincidunt vestibulum, urna dui ultrices dui, eget scelerisque ipsum libero ac elit. Cras bibendum mollis lorem id luctus.'),
(4, 'Architekt', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vivamus odio mauris, porta ac congue id, tempor eget mauris.'),
(5, 'PM', 'Morbi ac iaculis massa. Duis eget fermentum est, id faucibus ligula. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
`message_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `subject` varchar(80) NOT NULL,
  `content` longtext,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `positions`
--

CREATE TABLE IF NOT EXISTS `positions` (
`position_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `positions`
--

INSERT INTO `positions` (`position_id`, `name`) VALUES
(1, 'Tester'),
(2, 'Sieciowiec'),
(3, 'Programista'),
(4, 'Architekt'),
(5, 'PM'),
(6, 'Pracodawca');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
`question_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `content` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `questions`
--

INSERT INTO `questions` (`question_id`, `category_id`, `content`) VALUES
(1, 1, 'Co to jest iloczyn kartezjański?'),
(2, 1, 'Co mówi zasada Open/Closed?'),
(3, 2, 'Co NIE jest rodzajem skrętki?'),
(4, 1, 'Co oznacza O w akronimie SOLID?'),
(5, 1, 'Jaką funkcją można zliczyć ilość wierszy w rezultacie zapytania SQL?'),
(6, 1, 'When do you study?'),
(7, 1, 'According to Richard''s ...... the train leaves at 7 o''clock.'),
(8, 1, 'When you stay in a country for some time you get used to the people''s ...... of life.'),
(9, 1, 'Która z wypowiedzi najlepiej opisuje jedną z siedmiu podstawowych zasad testowania oprogramowania?'),
(10, 1, 'Czym jest testowanie manualne?'),
(11, 1, 'Czym jest testowanie automatyczne?'),
(12, 1, 'Czym jest testowanie wyczerpujące (exhaustive testing)?'),
(13, 1, 'Jakiego narzędzia używa się najczęściej do raportowania błędów?'),
(14, 1, 'Które z tych zadań powinno być przeprowadzone podczas analizy i projektowania testów?'),
(15, 1, 'Które z poniższych problemów zaobserwowanych podczas testów albo produkcji możemy uznać za niepowodzenie?'),
(16, 1, 'Który z poniższych jest przykładem testów konserwacyjnych?'),
(17, 2, 'Co NIE jest zaletą światłowodów?'),
(18, 2, 'Co oznacza F w standardzie 10Base-F?'),
(19, 2, 'Co oznacza liczba 1000 w standardzie 1000Base-F?'),
(20, 2, 'Która topologia sieci LAN wymaga huba?'),
(21, 2, 'Która z podanych jest zaletą topologii gwiazdy?'),
(22, 2, 'Na której warstwie modelu OSI pracuje switch?'),
(23, 2, 'Na której warstwie OSI pracuje repeater?'),
(24, 2, 'Który adres jest podzbiorem adresów z 2 warstwy OSI?'),
(25, 2, 'Wybierz właściwą kolejność warstw modelu OSI (1, 2…7).'),
(26, 2, 'Która z podanych warstw OSI odpowiada za pakowanie nieprzetworzonych bitów danych w ramki?'),
(27, 2, 'Która z podanych warstw OSI odpowiada za kodowanie i dekodowanie danych?'),
(28, 2, 'Który z podanych adresów należy do klasy B?'),
(29, 2, 'Jakie adresy IP mogą być użyte wewnątrz prywatnej sieci?'),
(30, 2, 'Które z podanych NIE jest usługą internetową?'),
(31, 3, 'Czy klasa moze dziedziczyć kilka interfejsów? '),
(32, 3, 'Jak przerwać działanie pętli for?'),
(33, 3, 'Który typ najlepiej nadaje się do przechowywania danych posortowanych?'),
(34, 3, 'Czy klasa może dziedziczyć z kilku klas jednocześnie?'),
(35, 3, 'Jaką funkcją można zliczyć ilość wierszy w rezultacie zapytania SQL?'),
(36, 3, 'Jak łączy wyniki dwóch tabel RIGHT OUTER JOIN?'),
(37, 3, 'Jak wywołać metodę w klasie podrzędnej z klasy nadrzędnej?'),
(38, 3, 'Co to jest iloczyn kartezjański?'),
(39, 3, 'Czy blok „catch” moze zawierać wewnątrz drugi blok try catch?'),
(40, 3, 'Co to jest konstruktor domyślny?'),
(41, 3, 'Po co stosuje się klasę abstrakcyjną?'),
(42, 3, 'Co zawiera stos?'),
(43, 3, 'Jaką zmienną nazywamy field (pole)?'),
(44, 3, 'Co oznacza słowo polimorfizm?'),
(45, 3, 'Jaka interfejs w JAVIE wykorzystywany jest do porównywania dwóch obiektów?'),
(46, 3, 'Co oznacza D w akronimie SOLID?'),
(47, 3, 'Której cechy język obiektowy nie musi posiadać?'),
(48, 3, 'Który element nie występuje w JavaScripcie?'),
(49, 3, 'Klasy "lekkie", deklarowane jako struct, alokowane na stosie i nie pozwalające na dziedziczenie występują w:'),
(50, 3, 'Co oznacza O w akronimie SOLID?'),
(51, 3, 'Czego najlepiej unikać w używaniu synchronized na bloku kodu?'),
(52, 3, 'Co oznacza S w akronimie SOLID?'),
(53, 3, 'Co oznacza L w akronimie SOLID?'),
(54, 3, 'Kiedy garbage collector wie że może usunąć instancję obiektu?'),
(55, 3, 'Co oznacza I w akronimie SOLID?'),
(56, 3, 'Jaki stan NIE jest stanem wątku?'),
(57, 3, 'Co mówi zasada Open/Closed?'),
(58, 3, 'Co oznacza złożoność O(n)?'),
(59, 3, 'Co mówi zasada podstawienia Liskov?'),
(60, 4, 'Ile rodzajów diagramów możemy wyróżnić w BPMN?'),
(61, 4, 'Czego nie opisuje BPMN?'),
(62, 4, 'Które z podanych nie jest zdarzeniem w BPMN?'),
(63, 4, 'Jakiej bramki nie znajdziemy W BPMN?'),
(64, 4, 'Jaką metodykę wybrałbyś gdyby projekt wymagał częstych kontaktów z klientem?'),
(65, 4, 'Jaką metodykę wybrałbyś gdyby kluczowym elementem projektu był zespół?'),
(66, 4, 'Jaką metodykę wybrałbyś gdyby wasz zespół miał duże doświadczenie w podobnych projektach?'),
(67, 4, 'Jaką metodykę wybrałbyś gdyby można było opracować dokładny plan projektu?'),
(68, 4, 'W notacji UML interfejs reprezentowany jest jako…?'),
(69, 4, 'W notacji UML kompozycja jest reprezentowana przez…?'),
(70, 4, 'W notacji UML agregacja jest reprezentowana przez…?'),
(71, 4, 'Gdybyś chciał pokazać fizycznie relacje pomiędzy komponentami oprogramowania a hardwarem, który diagram byś wybrał?'),
(72, 4, 'When do you study?'),
(73, 4, 'According to Richards ...... the train leaves at 7 oclock.'),
(74, 4, 'When you stay in a country for some time you get used to the peoples ...... of life.'),
(75, 5, 'When do you study?'),
(76, 5, 'According to Richards ...... the train leaves at 7 oclock.'),
(77, 5, 'When you stay in a country for some time you get used to the peoples ...... of life.'),
(78, 5, 'Co oznacza słowo polimorfizm w kontekście języka JAVA?'),
(79, 5, 'Której cechy język obiektowy nie musi posiadać?'),
(80, 5, 'Klasy "lekkie", deklarowane jako struct, alokowane na stosie i nie pozwalające na dziedziczenie występują w:'),
(81, 5, 'Co oznacza O w akronimie SOLID?'),
(82, 5, 'Co oznacza złożoność O(n)?'),
(83, 5, 'Co mówi zasada Open/Closed?'),
(84, 5, 'Który język działa po stronie klienta?'),
(85, 5, 'Od czego powinien zaczynać się każdy projekt?'),
(86, 5, 'Ustaw podane czynności wg kolejności wykonywania podczas projektu: motywowanie pracowników, organizacja działań, monitorowanie jakości.'),
(87, 5, 'Jak do kontroli i monitoringu postępów powinien podchodzić PM?'),
(88, 5, 'Co ma na celu przydzielanie nagród pracownikom za błędy znalezione przez nich w pracy innych zatrudnionych?');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `test`
--

CREATE TABLE IF NOT EXISTS `test` (
`test_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `salt` varchar(128) NOT NULL,
  `email` varchar(30) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
 ADD PRIMARY KEY (`answer_id`), ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
 ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
 ADD PRIMARY KEY (`message_id`), ADD KEY `sender_id` (`sender_id`), ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
 ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
 ADD PRIMARY KEY (`question_id`), ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
 ADD PRIMARY KEY (`test_id`), ADD KEY `user_id` (`user_id`), ADD KEY `answer_id` (`answer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`), ADD KEY `position_id` (`position_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `answers`
--
ALTER TABLE `answers`
MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=288;
--
-- AUTO_INCREMENT dla tabeli `categories`
--
ALTER TABLE `categories`
MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT dla tabeli `messages`
--
ALTER TABLE `messages`
MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `positions`
--
ALTER TABLE `positions`
MODIFY `position_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT dla tabeli `questions`
--
ALTER TABLE `questions`
MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=89;
--
-- AUTO_INCREMENT dla tabeli `test`
--
ALTER TABLE `test`
MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `answers`
--
ALTER TABLE `answers`
ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`);

--
-- Ograniczenia dla tabeli `messages`
--
ALTER TABLE `messages`
ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`user_id`),
ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`user_id`);

--
-- Ograniczenia dla tabeli `questions`
--
ALTER TABLE `questions`
ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Ograniczenia dla tabeli `test`
--
ALTER TABLE `test`
ADD CONSTRAINT `test_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
ADD CONSTRAINT `test_ibfk_2` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`answer_id`);

--
-- Ograniczenia dla tabeli `users`
--
ALTER TABLE `users`
ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`position_id`) REFERENCES `positions` (`position_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
