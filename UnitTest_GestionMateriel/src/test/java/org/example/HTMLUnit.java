package org.example;

import com.gargoylesoftware.htmlunit.WebClient;
import com.gargoylesoftware.htmlunit.html.*;
import org.junit.jupiter.api.Test;

import static org.junit.jupiter.api.Assertions.*;

public class HTMLUnit {

    @Test
    public void loginPage() throws Exception {
        try (final WebClient webClient = new WebClient()) {
            webClient.getOptions().setFetchPolyfillEnabled(true);
            final HtmlPage page = webClient.getPage("http://localhost:8888/QualiLogProject/LoginPage.php");

            assertEquals("Gestion de Matériel | Connexion", page.getTitleText());

            // get form
            final HtmlForm form = page.getForms().get(0);

            // get input fields
            final HtmlEmailInput mail = form.getInputByName("Mail");
            final HtmlPasswordInput password = form.getInputByName("Password");

            // get submit button
            final HtmlButton button = form.getFirstByXPath("/html/body/form/div/button");

            // click with empty input fields
            final HtmlPage page2 = button.click();
            assertEquals("Gestion de Matériel | Connexion", page2.getTitleText());

            // fill input fields
            mail.setValueAttribute("user@user.user");
            password.setValueAttribute("user");

            // click with filled input fieldsi
            final HtmlPage page3 = button.click();
            assertEquals("Gestion de Matériel | Accueil", page3.getTitleText());
        }
    }
}
