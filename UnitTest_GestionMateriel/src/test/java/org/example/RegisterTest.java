package org.example;

import com.gargoylesoftware.htmlunit.WebClient;
import com.gargoylesoftware.htmlunit.html.HtmlAnchor;
import com.gargoylesoftware.htmlunit.html.HtmlPage;
import org.junit.jupiter.api.DisplayName;
import org.junit.jupiter.api.Test;
import static org.junit.jupiter.api.Assertions.assertEquals;

public class RegisterTest {

    @Test
    @DisplayName("Successful register")
    public void successfulRegister() throws Exception {
        try(final WebClient webClient = new WebClient()) {
            HtmlPage page = webClient.getPage("https://thomas-raymond.fr/QualiLogProject/LoginPage.php");
            assertEquals("Gestion de Matériel | Connexion", page.getTitleText());

            HtmlAnchor anchor = (HtmlAnchor) page.getByXPath("//a[@href='RegisterPage.php']").get(0);
            HtmlPage registerPage = anchor.click();

            assertEquals("Gestion de Matériel | Inscription", registerPage.getTitleText());
        }
    }
}
