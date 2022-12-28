package org.example;

import com.gargoylesoftware.htmlunit.WebClient;
import com.gargoylesoftware.htmlunit.html.*;
import jakarta.persistence.EntityManager;
import jakarta.persistence.EntityManagerFactory;
import jakarta.persistence.EntityTransaction;
import jakarta.persistence.Persistence;
import org.junit.jupiter.api.*;
import java.io.IOException;

import static org.junit.jupiter.api.Assertions.assertEquals;

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
    @DisplayName("Connexion")
    class C {

        @Test
        @DisplayName("Connexion réussie (C01)")
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
            em.getTransaction().begin();
            em.remove(user);
            em.getTransaction().commit();
        }


        @Nested
        @DisplayName("Connexion refusée (C02)")
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
                em.createQuery("DELETE FROM wl_users WHERE Mail = '" + user.getMail() + "'").executeUpdate();
                tx.commit();
            }

            @Test
            @DisplayName("Mot de passe incorrect")
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

                // click with filled input fields
                HtmlPage page2 = button.click();
                System.out.println(page2.asNormalizedText());
                assertEquals("Gestion de Matériel | Connexion", page2.getTitleText());
            }
        }
    }
}
