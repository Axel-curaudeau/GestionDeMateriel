package org.example;

import com.gargoylesoftware.htmlunit.WebClient;
import com.gargoylesoftware.htmlunit.html.*;
import jakarta.persistence.EntityManager;
import jakarta.persistence.EntityManagerFactory;
import jakarta.persistence.EntityTransaction;
import jakarta.persistence.Persistence;
import org.junit.jupiter.api.AfterAll;
import org.junit.jupiter.api.BeforeAll;
import org.junit.jupiter.api.DisplayName;
import org.junit.jupiter.api.Test;
import org.w3c.dom.Entity;

import java.util.concurrent.ExecutionException;

import static org.junit.jupiter.api.Assertions.assertEquals;

public class LoginPage {

    private static EntityManagerFactory emf;
    private static EntityManager em;
    private static EntityTransaction tx;

    @BeforeAll
    public static void setup() {
        emf = Persistence.createEntityManagerFactory("QualiLog");
        em = emf.createEntityManager();
        tx = em.getTransaction();

        tx.begin();
        wl_users user = new wl_users("John", "Doe", "johndoe@hibernate.com", 1);
        em.persist(user);
        tx.commit();
    }

    @AfterAll
    public static void tearDown() {
        //delete user with mail = johndoe@hibernate.com
        tx.begin();
        em.createQuery("DELETE FROM wl_users WHERE Mail = 'johndoe@hibernate.com'").executeUpdate();
        tx.commit();

        em.close();
        emf.close();
    }

    @Test
    @DisplayName("Successful login")
    public void successfulLogin() throws Exception {
        try (final WebClient webClient = new WebClient()) {
            webClient.getOptions().setFetchPolyfillEnabled(true);

            // Get login page
            HtmlPage page = webClient.getPage("http://localhost:8888/QualiLogProject/LoginPage.php");

            // Check page title
            assertEquals("Gestion de Matériel | Connexion", page.getTitleText());

            // Get Form
            HtmlForm form = page.getForms().get(0);

            // Get input fields
            HtmlEmailInput mail = form.getInputByName("Mail");
            HtmlPasswordInput password = form.getInputByName("Password");

            // get submit button
            HtmlButton button = form.getFirstByXPath("/html/body/form/div/button");

            // fill input fields
            mail.setValueAttribute("johndoe@hibernate.com");
            password.setValueAttribute("user");

            // click with filled input fields
            HtmlPage page2 = button.click();
            assertEquals("Gestion de Matériel | Accueil", page2.getTitleText());
        }
    }
}
