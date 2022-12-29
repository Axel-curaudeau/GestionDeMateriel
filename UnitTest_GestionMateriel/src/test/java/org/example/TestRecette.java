package org.example;

import com.gargoylesoftware.htmlunit.Page;
import com.gargoylesoftware.htmlunit.WebClient;
import com.gargoylesoftware.htmlunit.html.*;
import jakarta.persistence.*;
import net.sourceforge.htmlunit.xpath.operations.Bool;
import org.hibernate.Session;
import org.hibernate.query.sql.internal.SQLQueryParser;
import org.junit.jupiter.api.*;
import java.io.IOException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Scanner;

import static org.junit.jupiter.api.Assertions.*;

public class TestRecette {
    private static EntityManagerFactory emf;
    private static EntityManager em;
    private static EntityTransaction tx;

    @BeforeAll
    public static void BDD_Connection() {
        emf = Persistence.createEntityManagerFactory(Constantes.PERSISTENCE_UNIT_NAME);
        em = emf.createEntityManager();
        tx = em.getTransaction();
    }

    @AfterAll
    public static void tearDown() {
        em.close();
        emf.close();
    }

    @Nested
    @DisplayName("Fonctionnement général (G)")
    class G {
        @Test
        @DisplayName("Accès aux pages (G1)")
        void G1() throws IOException {
            HashMap<String, String> pages = new HashMap<>();   // <relativeUrl, resultUrlWhenNotConnected>
            pages.put("AddNewDevice.php", "LoginPage.php?alerte=notConnected");
            pages.put("AddNewReservation.php", "LoginPage.php?alerte=notConnected");
            pages.put("AdminPageAccounts.php", "LoginPage.php?alerte=notConnected");
            pages.put("Alertes.php", "Alertes.php");
            pages.put("ChangeUser.php", "LoginPage.php?alerte=notConnected");
            pages.put("ChangeUserAdmin.php", "LoginPage.php?alerte=notConnected");
            pages.put("ChangeUserPage.php", "LoginPage.php?alerte=notConnected");
            pages.put("Deconnexion.php", "LoginPage.php");
            pages.put("DeleteMaterial.php", "LoginPage.php?alerte=notConnected");
            pages.put("DeleteReservation.php", "LoginPage.php?alerte=notConnected");
            pages.put("DeleteUser.php", "LoginPage.php?alerte=notConnected");
            pages.put("dispoJSON.php", "dispoJSON.php");
            pages.put("ForgotPswd.php", "ForgotPswd.php");
            pages.put("Home.php", "LoginPage.php?alerte=notConnected");
            pages.put("Login.php", "LoginPage.php?alerte=failConnect");
            pages.put("LoginPage.php", "LoginPage.php");
            pages.put("menubar.php", "menubar.php");
            pages.put("Profil.php", "LoginPage.php?alerte=notConnected");
            pages.put("ProfilPage.php", "LoginPage.php?alerte=notConnected");
            pages.put("Register.php", "RegisterPage.php?alerte=emptyField");    // TODO : à modifier sur le site
            pages.put("RegisterPage.php", "RegisterPage.php");
            pages.put("ReservationPage.php", "LoginPage.php?alerte=notConnected");
            pages.put("UpdateResetPswd.php", "ForgotPswd.php?alerte=wrongEmail");

            // Création du client web
            WebClient webClient = new WebClient();
            webClient.getOptions().setFetchPolyfillEnabled(true);


            /* --- Tests pour chaque page --- */

            for (String page : pages.keySet()) {
                Page htmlPage = webClient.getPage(Constantes.URL + page);
                assertEquals(Constantes.URL + pages.get(page), htmlPage.getUrl().toString(), "Error while accessing " + page);
            }
        }
    }

    @Nested
    @DisplayName("Connexion (C)")
    class C {

        @Test
        @DisplayName("Connexion réussie (C1)")
        void C01() throws IOException {
            /* --- Création de l'utilisateur dans la BDD --- */
            tx.begin();
            wl_users user = new wl_users("John", "Doe", "johndoe@hibernate.com", 1);
            em.persist(user);
            tx.commit();


            /* --- Accès à la page --- */
            // Création du client web
            WebClient webClient = new WebClient();
            webClient.getOptions().setFetchPolyfillEnabled(true);
            HtmlPage page = webClient.getPage(Constantes.URL + "LoginPage.php");

            // Vérification du titre de la page
            assertEquals("Gestion de Matériel | Connexion", page.getTitleText(), "Le titre de la page n'est pas correct (mauvaise page ?)");

            // Get Form
            HtmlForm form = page.getForms().get(0);

            // Get input fields
            HtmlEmailInput mail = form.getInputByName("Mail");
            HtmlPasswordInput password = form.getInputByName("Password");

            // get submit button
            HtmlButton button = form.getFirstByXPath("/html/body/form/div/button");

            // fill input fields
            mail.setValueAttribute(user.getMail());
            password.setValueAttribute(user.getPswd());

            // click with filled input fields
            HtmlPage page2 = button.click();
            assertEquals("Gestion de Matériel | Accueil", page2.getTitleText());


            /* --- Suppression de l'utilisateur de la BDD --- */
            tx.begin();
            em.remove(user);
            tx.commit();
        }


        @Nested
        @DisplayName("Connexion refusée (C2)")
        class C02 {
            static wl_users user;

            @BeforeAll
            public static void createUser() {
                /* --- Création de l'utilisateur dans la BDD --- */
                tx.begin();
                user = new wl_users("John", "Doe", "johndoe@hibernate.com", 1);
                em.persist(user);
                tx.commit();
            }

            @AfterAll
            public static void deleteUser() {
                /* --- Suppression de l'utilisateur de la BDD --- */
                tx.begin();
                em.remove(user);
                tx.commit();
            }

            @Test
            @DisplayName("Mot de passe incorrect (C2_1)")
            void C02_1() throws IOException {
                /* --- Accès à la page --- */
                // Création du client web
                WebClient webClient = new WebClient();
                webClient.getOptions().setFetchPolyfillEnabled(true);
                HtmlPage page = webClient.getPage(Constantes.URL + "LoginPage.php");

                // Vérification du titre de la page
                assertEquals("Gestion de Matériel | Connexion", page.getTitleText(), "Le titre de la page n'est pas correct (mauvaise page ?)");

                // Get Form
                HtmlForm form = page.getForms().get(0);

                // Get input fields
                HtmlEmailInput mail = form.getInputByName("Mail");
                HtmlPasswordInput password = form.getInputByName("Password");

                // get submit button
                HtmlButton button = form.getFirstByXPath("/html/body/form/div/button");

                // fill input fields
                mail.setValueAttribute(user.getMail());
                password.setValueAttribute("wrongPassword");

                // Verify validity of input fields format
                assertTrue(mail.isValid());
                assertTrue(password.isValid());

                // click with filled input fields
                HtmlPage page2 = button.click();
                assertEquals("Gestion de Matériel | Connexion", page2.getTitleText());
                assertTrue(page2.asNormalizedText().contains("Identifiants incorrects"));
            }

            @Test
            @DisplayName("Adresse mail incorrecte (C2_2)")
            void C02_2() throws IOException {
                /* --- Accès à la page --- */
                // Création du client web
                WebClient webClient = new WebClient();
                webClient.getOptions().setFetchPolyfillEnabled(true);
                HtmlPage page = webClient.getPage(Constantes.URL + "LoginPage.php");

                // Vérification du titre de la page
                assertEquals("Gestion de Matériel | Connexion", page.getTitleText(), "Le titre de la page n'est pas correct (mauvaise page ?)");

                // Get Form
                HtmlForm form = page.getForms().get(0);

                // Get input fields
                HtmlEmailInput mail = form.getInputByName("Mail");
                HtmlPasswordInput password = form.getInputByName("Password");

                // get submit button
                HtmlButton button = form.getFirstByXPath("/html/body/form/div/button");

                // fill input fields
                mail.setValueAttribute("wrongMail");
                password.setValueAttribute(user.getPswd());

                // Verify validity of input fields format
                assertFalse(mail.isValid());
                assertTrue(password.isValid());

                // click with filled input fields
                HtmlPage page2 = button.click();
                assertEquals("Gestion de Matériel | Connexion", page2.getTitleText());
            }

            @Test
            @DisplayName("Champs vides (C2_3)")
            void C02_3() throws IOException {
                /* --- Accès à la page --- */
                // Création du client web
                WebClient webClient = new WebClient();
                webClient.getOptions().setFetchPolyfillEnabled(true);
                HtmlPage page = webClient.getPage(Constantes.URL + "LoginPage.php");

                // Vérification du titre de la page
                assertEquals("Gestion de Matériel | Connexion", page.getTitleText(), "Le titre de la page n'est pas correct (mauvaise page ?)");

                // Get Form
                HtmlForm form = page.getForms().get(0);

                // Get input fields
                HtmlEmailInput mail = form.getInputByName("Mail");
                HtmlPasswordInput password = form.getInputByName("Password");

                // get submit button
                HtmlButton button = form.getFirstByXPath("/html/body/form/div/button");

                // fill input fields
                mail.setValueAttribute("");
                password.setValueAttribute("");

                // Verify validity of input fields format
                assertFalse(mail.isValid());
                assertFalse(password.isValid());

                // click with filled input fields
                HtmlPage page2 = button.click();
                assertEquals("Gestion de Matériel | Connexion", page2.getTitleText());
            }
        }

    }

    @Nested
    @DisplayName("Inscription (I)")
    class I {
        @Test
        @DisplayName("Inscription réussie (I1)")
        void I01() throws IOException {
            wl_users user = new wl_users("John", "Doe", "johndoe@hibernate.com", 1);

            /* --- Accès à la page --- */
            // Création du client web
            WebClient webClient = new WebClient();
            webClient.getOptions().setFetchPolyfillEnabled(true);
            HtmlPage page = webClient.getPage(Constantes.URL + "RegisterPage.php");

            // Vérification du titre de la page
            assertEquals("Gestion de matériel | Inscription", page.getTitleText(), "Le titre de la page n'est pas correct (mauvaise page ?)");
            // TODO : Changer titre pour "Gestion de Matériel | Inscription"

            // Get Form
            HtmlForm form = page.getForms().get(0);

            // Get input fields
            HtmlTextInput firstName = form.getInputByName("FirstName");
            HtmlTextInput lastName = form.getInputByName("LastName");
            HtmlEmailInput mail = form.getInputByName("Mail");
            HtmlPasswordInput password = form.getInputByName("MotDePasse");

            // get submit button
            HtmlButton button = form.getFirstByXPath("/html/body/form/div/button");

            // fill input fields
            firstName.setValueAttribute(user.getFirstName());
            lastName.setValueAttribute(user.getLastName());
            mail.setValueAttribute(user.getMail());
            password.setValueAttribute(user.getPswd());

            // Verify validity of input fields format
            assertTrue(firstName.isValid());
            assertTrue(lastName.isValid());
            assertTrue(mail.isValid());
            assertTrue(password.isValid());

            // click with filled input fields
            HtmlPage page2 = button.click();
            assertEquals("Gestion de Matériel | Connexion", page2.getTitleText());
            // TODO : Ajouter une alerte de succès

            // Vérification de l'ajout en base de données
            Session session = em.unwrap(Session.class);
            Query query = session.createQuery("from wl_users where Mail = :mail").setParameter("mail", user.getMail());
            wl_users user2 = (wl_users) ((org.hibernate.query.Query<?>) query).uniqueResult();
            assertTrue(user.equals(user2));

            /* --- Suppression de l'utilisateur de la BDD --- */
            tx.begin();
            em.remove(user2);
            tx.commit();
        }
    }
}
