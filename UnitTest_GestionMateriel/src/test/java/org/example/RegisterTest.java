package org.example;

import com.gargoylesoftware.htmlunit.ConfirmHandler;
import com.gargoylesoftware.htmlunit.WebClient;
import com.gargoylesoftware.htmlunit.html.*;
import org.junit.jupiter.api.DisplayName;
import org.junit.jupiter.api.Test;
import static org.junit.jupiter.api.Assertions.assertEquals;

public class RegisterTest {

    @Test
    @DisplayName("Successful register")
    public void successfulRegister() throws Exception {
        try(final WebClient webClient = new WebClient()) {
            webClient.getOptions().setFetchPolyfillEnabled(true);

            //Accessing the Register page
            HtmlPage page = webClient.getPage("https://thomas-raymond.fr/QualiLogProject/LoginPage.php");
            assertEquals("Gestion de Matériel | Connexion", page.getTitleText());

            HtmlAnchor anchor = (HtmlAnchor) page.getByXPath("//a[@href='RegisterPage.php']").get(0);
            HtmlPage registerPage = anchor.click();

            //Filling the form
            assertEquals("Gestion de Matériel | Inscription", registerPage.getTitleText());
            HtmlTextInput FirstNameField = (HtmlTextInput) registerPage.getByXPath("//input[@name='FirstName']").get(0);
            HtmlTextInput LastNameField = (HtmlTextInput) registerPage.getByXPath("//input[@name='LastName']").get(0);
            HtmlEmailInput EmailField = (HtmlEmailInput) registerPage.getByXPath("//input[@name='Mail']").get(0);
            HtmlPasswordInput PasswordField = (HtmlPasswordInput) registerPage.getByXPath("//input[@name='MotDePasse']").get(0);
            HtmlPasswordInput PasswordConfirmField = (HtmlPasswordInput) registerPage.getByXPath("//input[@name='ConfirmMotDePasse']").get(0);

            FirstNameField.setValueAttribute("TestUserFistName");
            LastNameField.setValueAttribute("TestUserLastName");
            EmailField.setValueAttribute("test@test.test");
            PasswordField.setValueAttribute("test");
            PasswordConfirmField.setValueAttribute("test");

            //Submitting the form and checking the result
            HtmlButton submitButton = (HtmlButton) registerPage.getByXPath("//button[@type='submit']").get(0);
            HtmlPage registerSuccessPage = submitButton.click();

            assertEquals("Gestion de Matériel | Connexion", registerSuccessPage.getTitleText());

            //Cleaning the database
            //Logging as admin
            HtmlEmailInput LoginEmailField = (HtmlEmailInput) registerSuccessPage.getByXPath("//input[@name='Mail']").get(0);
            PasswordField = (HtmlPasswordInput) registerSuccessPage.getByXPath("//input[@name='Password']").get(0);

            LoginEmailField.setValueAttribute("admin@admin.admin");
            PasswordField.setValueAttribute("admin");

            HtmlButton loginSubmitButton = (HtmlButton) registerSuccessPage.getByXPath("//button[@type='submit']").get(0);
            HtmlPage homePage = loginSubmitButton.click();

            assertEquals("Gestion de Matériel | Accueil", homePage.getTitleText());

            //Accessing the account management page
            anchor = (HtmlAnchor) homePage.getByXPath("//a[@href='AdminPageAccounts.php']").get(0);
            HtmlPage accountPage = anchor.click();

            assertEquals("Gestion de Matériel | Comptes", accountPage.getTitleText());

            //Deleting the test account
            HtmlTableDataCell testUserRow = (HtmlTableDataCell) accountPage.getByXPath("//td[text()='test@test.test']").get(0);
            HtmlTableRow row = (HtmlTableRow) testUserRow.getParentNode();

            HtmlImage deleteButton = (HtmlImage) row.getByXPath("//img[@onclick='DeleteUser(" + row.getAttribute("id") + ")']").get(0);
            HtmlPage deletePage = (HtmlPage) deleteButton.click();

            //confirm delete
            webClient.setConfirmHandler((ConfirmHandler) (page1, message) -> true);
            webClient.getConfirmHandler().handleConfirm(page, "Supprimer");

            assertEquals(0, deletePage.getByXPath("//td[text()='test@test.test']").size());
        }
    }
}
