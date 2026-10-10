-- Active: 1791363478613@@127.0.0.1@3306
-- =====================================================================
-- BiblioTech - Jeu de données de test (SQLite)
-- A exécuter APRES les migrations (php artisan migrate).
-- Prérequis : la médiathèque n° 1 et les membres n° 2, 3 et 4 existent déjà.
-- Les dates sont calculées à partir du jour d'exécution (date('now', ...)).
-- Le script peut être relancé : INSERT OR IGNORE ignore les lignes déjà présentes.
-- =====================================================================

BEGIN TRANSACTION;

-- ---------------------------------------------------------------------
-- MEDIATHEQUES (la n° 1 « Médiathèque Centre » existe déjà)
-- ---------------------------------------------------------------------
INSERT OR IGNORE INTO libraries (id, name, number, track_type, street, city, created_at, updated_at) VALUES
(2, 'Médiathèque Nord', '3 bis', 'avenue', 'Foch', 'Villeurbanne', datetime('now'), datetime('now')),
(3, 'Médiathèque Sud', '48', 'boulevard', 'des Tchécoslovaques', 'Vénissieux', datetime('now'), datetime('now'));

-- ---------------------------------------------------------------------
-- GENRES
-- ---------------------------------------------------------------------
INSERT OR IGNORE INTO genres (id, wording, created_at, updated_at) VALUES
(1, 'Roman', datetime('now'), datetime('now')),
(2, 'Classique', datetime('now'), datetime('now')),
(3, 'Science-fiction', datetime('now'), datetime('now')),
(4, 'Fantasy', datetime('now'), datetime('now')),
(5, 'Policier', datetime('now'), datetime('now')),
(6, 'Jeunesse', datetime('now'), datetime('now')),
(7, 'Bande dessinée', datetime('now'), datetime('now'));

-- ---------------------------------------------------------------------
-- AUTEURS (Voltaire sans prénom)
-- ---------------------------------------------------------------------
INSERT OR IGNORE INTO authors (id, name, firstname, created_at, updated_at) VALUES
(1, 'Camus', 'Albert', datetime('now'), datetime('now')),
(2, 'Hugo', 'Victor', datetime('now'), datetime('now')),
(3, 'Zola', 'Émile', datetime('now'), datetime('now')),
(4, 'Saint-Exupéry', 'Antoine de', datetime('now'), datetime('now')),
(5, 'Orwell', 'George', datetime('now'), datetime('now')),
(6, 'Asimov', 'Isaac', datetime('now'), datetime('now')),
(7, 'Herbert', 'Frank', datetime('now'), datetime('now')),
(8, 'Tolkien', 'J. R. R.', datetime('now'), datetime('now')),
(9, 'Rowling', 'J. K.', datetime('now'), datetime('now')),
(10, 'Christie', 'Agatha', datetime('now'), datetime('now')),
(11, 'Conan Doyle', 'Arthur', datetime('now'), datetime('now')),
(12, 'Sagan', 'Françoise', datetime('now'), datetime('now')),
(13, 'Goscinny', 'René', datetime('now'), datetime('now')),
(14, 'Uderzo', 'Albert', datetime('now'), datetime('now')),
(15, 'Voltaire', NULL, datetime('now'), datetime('now'));

-- ---------------------------------------------------------------------
-- OEUVRES (ISBN fictifs de test)
-- ---------------------------------------------------------------------
INSERT OR IGNORE INTO books (id, isbn, title, edition, year, cover, summary, created_at, updated_at) VALUES
(1, '9782070000001', 'L''Étranger', 'Gallimard', 1942, NULL, 'Meursault, employé de bureau à Alger, commet un meurtre sans raison apparente.', datetime('now'), datetime('now')),
(2, '9782070000002', 'La Peste', 'Gallimard', 1947, NULL, 'Une épidémie de peste frappe la ville d''Oran, mise en quarantaine.', datetime('now'), datetime('now')),
(3, '9782070000003', 'Les Misérables', 'Le Livre de Poche', 1862, NULL, 'Le destin de Jean Valjean, ancien forçat en quête de rédemption.', datetime('now'), datetime('now')),
(4, '9782070000004', 'Notre-Dame de Paris', 'Le Livre de Poche', 1831, NULL, 'Quasimodo, Esmeralda et Frollo dans le Paris du XVe siècle.', datetime('now'), datetime('now')),
(5, '9782070000005', 'Germinal', 'Le Livre de Poche', 1885, NULL, 'La grève des mineurs du Nord racontée à travers Étienne Lantier.', datetime('now'), datetime('now')),
(6, '9782070000006', 'Le Petit Prince', 'Gallimard', 1943, NULL, 'Un aviateur échoué dans le désert rencontre un petit prince venu d''une autre planète.', datetime('now'), datetime('now')),
(7, '9782070000007', '1984', 'Gallimard', 1949, NULL, 'Winston Smith vit sous la surveillance permanente de Big Brother.', datetime('now'), datetime('now')),
(8, '9782070000008', 'Fondation', 'Gallimard', 1951, NULL, 'Hari Seldon prévoit la chute de l''Empire galactique.', datetime('now'), datetime('now')),
(9, '9782070000009', 'Dune', 'Pocket', 1965, NULL, 'Paul Atréides sur Arrakis, la planète des sables.', datetime('now'), datetime('now')),
(10, '9782070000010', 'Le Seigneur des anneaux', 'Christian Bourgois', 1954, NULL, 'Frodon doit détruire l''Anneau unique.', datetime('now'), datetime('now')),
(11, '9782070000011', 'Harry Potter à l''école des sorciers', 'Gallimard Jeunesse', 1997, NULL, 'Harry découvre qu''il est un sorcier et entre à Poudlard.', datetime('now'), datetime('now')),
(12, '9782070000012', 'Le Crime de l''Orient-Express', 'Le Masque', 1934, NULL, 'Hercule Poirot enquête sur un meurtre dans un train bloqué par la neige.', datetime('now'), datetime('now')),
(13, '9782070000013', 'Ils étaient dix', 'Le Masque', 1939, NULL, 'Dix inconnus invités sur une île meurent un à un.', datetime('now'), datetime('now')),
(14, '9782070000014', 'Le Chien des Baskerville', 'Le Livre de Poche', 1902, NULL, 'Sherlock Holmes face à la légende d''un chien maudit.', datetime('now'), datetime('now')),
(15, '9782070000015', 'Bonjour tristesse', 'Pocket', 1954, NULL, 'Un été sur la Côte d''Azur qui tourne au drame.', datetime('now'), datetime('now')),
(16, '9782070000016', 'Astérix le Gaulois', 'Hachette', 1961, NULL, 'Un petit village gaulois résiste encore et toujours à l''envahisseur.', datetime('now'), datetime('now')),
(17, '9782070000017', 'Candide', 'Le Livre de Poche', 1759, NULL, 'Candide parcourt le monde en se demandant si tout est pour le mieux.', datetime('now'), datetime('now'));

-- ---------------------------------------------------------------------
-- AUTEURS DES OEUVRES (ECRIRE) - Astérix a deux auteurs
-- ---------------------------------------------------------------------
INSERT OR IGNORE INTO author__books (book_id, author_id, created_at, updated_at) VALUES
(1, 1, datetime('now'), datetime('now')),
(2, 1, datetime('now'), datetime('now')),
(3, 2, datetime('now'), datetime('now')),
(4, 2, datetime('now'), datetime('now')),
(5, 3, datetime('now'), datetime('now')),
(6, 4, datetime('now'), datetime('now')),
(7, 5, datetime('now'), datetime('now')),
(8, 6, datetime('now'), datetime('now')),
(9, 7, datetime('now'), datetime('now')),
(10, 8, datetime('now'), datetime('now')),
(11, 9, datetime('now'), datetime('now')),
(12, 10, datetime('now'), datetime('now')),
(13, 10, datetime('now'), datetime('now')),
(14, 11, datetime('now'), datetime('now')),
(15, 12, datetime('now'), datetime('now')),
(16, 13, datetime('now'), datetime('now')),
(16, 14, datetime('now'), datetime('now')),
(17, 15, datetime('now'), datetime('now'));

-- ---------------------------------------------------------------------
-- GENRES DES OEUVRES (ASSIGNER)
-- ---------------------------------------------------------------------
INSERT OR IGNORE INTO book__genres (book_id, genre_id, created_at, updated_at) VALUES
(1, 1, datetime('now'), datetime('now')),
(1, 2, datetime('now'), datetime('now')),
(2, 1, datetime('now'), datetime('now')),
(2, 2, datetime('now'), datetime('now')),
(3, 1, datetime('now'), datetime('now')),
(3, 2, datetime('now'), datetime('now')),
(4, 1, datetime('now'), datetime('now')),
(4, 2, datetime('now'), datetime('now')),
(5, 1, datetime('now'), datetime('now')),
(5, 2, datetime('now'), datetime('now')),
(6, 6, datetime('now'), datetime('now')),
(6, 2, datetime('now'), datetime('now')),
(7, 3, datetime('now'), datetime('now')),
(7, 1, datetime('now'), datetime('now')),
(8, 3, datetime('now'), datetime('now')),
(9, 3, datetime('now'), datetime('now')),
(10, 4, datetime('now'), datetime('now')),
(11, 4, datetime('now'), datetime('now')),
(11, 6, datetime('now'), datetime('now')),
(12, 5, datetime('now'), datetime('now')),
(13, 5, datetime('now'), datetime('now')),
(14, 5, datetime('now'), datetime('now')),
(15, 1, datetime('now'), datetime('now')),
(16, 7, datetime('now'), datetime('now')),
(16, 6, datetime('now'), datetime('now')),
(17, 2, datetime('now'), datetime('now'));

-- ---------------------------------------------------------------------
-- EXEMPLAIRES - répartis entre les 3 médiathèques
-- ---------------------------------------------------------------------
INSERT OR IGNORE INTO copies (id, state, book_id, library_id, created_at, updated_at) VALUES
(1, 'good', 1, 2, datetime('now'), datetime('now')),
(2, 'good', 1, 3, datetime('now'), datetime('now')),
(3, 'worn', 1, 1, datetime('now'), datetime('now')),
(4, 'good', 2, 3, datetime('now'), datetime('now')),
(5, 'worn', 2, 1, datetime('now'), datetime('now')),
(6, 'worn', 3, 1, datetime('now'), datetime('now')),
(7, 'damaged', 3, 2, datetime('now'), datetime('now')),
(8, 'damaged', 4, 2, datetime('now'), datetime('now')),
(9, 'new', 5, 3, datetime('now'), datetime('now')),
(10, 'good', 5, 1, datetime('now'), datetime('now')),
(11, 'good', 6, 1, datetime('now'), datetime('now')),
(12, 'good', 6, 2, datetime('now'), datetime('now')),
(13, 'worn', 6, 3, datetime('now'), datetime('now')),
(14, 'good', 7, 2, datetime('now'), datetime('now')),
(15, 'worn', 7, 3, datetime('now'), datetime('now')),
(16, 'damaged', 7, 1, datetime('now'), datetime('now')),
(17, 'worn', 8, 3, datetime('now'), datetime('now')),
(18, 'damaged', 8, 1, datetime('now'), datetime('now')),
(19, 'damaged', 9, 1, datetime('now'), datetime('now')),
(20, 'new', 9, 2, datetime('now'), datetime('now')),
(21, 'new', 10, 2, datetime('now'), datetime('now')),
(22, 'good', 10, 3, datetime('now'), datetime('now')),
(23, 'good', 11, 3, datetime('now'), datetime('now')),
(24, 'good', 11, 1, datetime('now'), datetime('now')),
(25, 'worn', 11, 2, datetime('now'), datetime('now')),
(26, 'good', 12, 1, datetime('now'), datetime('now')),
(27, 'worn', 12, 2, datetime('now'), datetime('now')),
(28, 'worn', 13, 2, datetime('now'), datetime('now')),
(29, 'damaged', 14, 3, datetime('now'), datetime('now')),
(30, 'new', 15, 1, datetime('now'), datetime('now')),
(31, 'good', 16, 2, datetime('now'), datetime('now')),
(32, 'good', 16, 3, datetime('now'), datetime('now')),
(33, 'good', 17, 3, datetime('now'), datetime('now'));

-- ---------------------------------------------------------------------
-- EMPRUNTS - durée 21 jours - membres 2, 3 et 4
-- "return" à NULL = exemplaire pas encore rendu
-- ---------------------------------------------------------------------
INSERT OR IGNORE INTO loans (id, start, "limit", "return", copy_id, user_id, created_at, updated_at) VALUES
(1, date('now', '-120 days'), date('now', '-99 days'), date('now', '-105 days'), 1, 2, datetime('now'), datetime('now')),
(2, date('now', '-90 days'), date('now', '-69 days'), date('now', '-75 days'), 14, 2, datetime('now'), datetime('now')),
(3, date('now', '-70 days'), date('now', '-49 days'), date('now', '-52 days'), 21, 2, datetime('now'), datetime('now')),
(4, date('now', '-5 days'), date('now', '+16 days'), NULL, 26, 2, datetime('now'), datetime('now')),  -- en cours
(5, date('now', '-40 days'), date('now', '-19 days'), NULL, 17, 2, datetime('now'), datetime('now')),  -- EN RETARD de 19 jours
(6, date('now', '-100 days'), date('now', '-79 days'), date('now', '-85 days'), 2, 3, datetime('now'), datetime('now')),
(7, date('now', '-80 days'), date('now', '-59 days'), date('now', '-66 days'), 15, 3, datetime('now'), datetime('now')),
(8, date('now', '-60 days'), date('now', '-39 days'), date('now', '-45 days'), 22, 3, datetime('now'), datetime('now')),
(9, date('now', '-50 days'), date('now', '-29 days'), date('now', '-35 days'), 19, 3, datetime('now'), datetime('now')),
(10, date('now', '-10 days'), date('now', '+11 days'), NULL, 23, 3, datetime('now'), datetime('now')),  -- en cours
(11, date('now', '-65 days'), date('now', '-44 days'), date('now', '-50 days'), 16, 4, datetime('now'), datetime('now')),
(12, date('now', '-30 days'), date('now', '-9 days'), date('now', '-12 days'), 20, 4, datetime('now'), datetime('now')),
(13, date('now', '-150 days'), date('now', '-129 days'), date('now', '-130 days'), 6, 4, datetime('now'), datetime('now')),
(14, date('now', '-35 days'), date('now', '-14 days'), NULL, 4, 4, datetime('now'), datetime('now'));  -- EN RETARD de 14 jours

-- ---------------------------------------------------------------------
-- AVIS (POSTER AVIS) - uniquement sur des oeuvres empruntées et rendues
-- ---------------------------------------------------------------------
INSERT OR IGNORE INTO reviews (user_id, book_id, note, comment, created_at, updated_at) VALUES
(2, 1, 5, 'Un classique indispensable, court et percutant.', datetime('now'), datetime('now')),
(2, 7, 4, 'Glaçant et toujours d''actualité.', datetime('now'), datetime('now')),
(2, 10, 5, 'Une aventure épique, on ne le lâche plus.', datetime('now'), datetime('now')),
(3, 1, 4, 'Déroutant mais marquant.', datetime('now'), datetime('now')),
(3, 7, 5, 'Mon livre préféré, à lire absolument.', datetime('now'), datetime('now')),
(3, 10, 4, 'Long à démarrer, mais quel univers !', datetime('now'), datetime('now')),
(3, 9, 5, 'Le chef-d''oeuvre de la science-fiction.', datetime('now'), datetime('now')),
(4, 7, 3, 'Intéressant mais un peu sombre.', datetime('now'), datetime('now')),
(4, 9, 4, 'Très riche, il faut s''accrocher au début.', datetime('now'), datetime('now')),
(4, 3, 5, 'Bouleversant, Jean Valjean est inoubliable.', datetime('now'), datetime('now'));

-- ---------------------------------------------------------------------
-- RESERVATIONS (RESERVER) - la file d'attente est ordonnée par created_at
-- ---------------------------------------------------------------------
INSERT OR IGNORE INTO user__books (user_id, book_id, created_at) VALUES
(4, 12, datetime('now', '-4 days')),
(2, 11, datetime('now', '-3 days')),
(3, 8, datetime('now', '-2 days'));

COMMIT;