package org.example;

import jakarta.persistence.*;

import java.time.LocalDateTime;

@Entity
public class wl_users {

    @Id
    private int UserID;

    private String FirstName;

    private String LastName;

    private String Mail;

    private String RegistrationNumber;

    private String Pswd;

    private int IsAdmin;

    private String ResetPswd;

    @Temporal(TemporalType.TIMESTAMP)
    private LocalDateTime LastResetPswd;

    public wl_users() {

    }

    public wl_users(String FirstName, String LastName, String Mail, int IsAdmin) {
        this.FirstName = FirstName;
        this.LastName = LastName;
        this.Mail = Mail;
        this.Pswd = "$2y$10$rz4y2mQ8pIJ4CJLfLG3/O.LBJpBQfm5aYoEBoGFEEXh6SGTLPcDAm"; // equiv to "user"
        this.IsAdmin = IsAdmin;
    }

}
