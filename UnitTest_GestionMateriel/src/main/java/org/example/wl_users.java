package org.example;

import jakarta.persistence.*;
import java.time.LocalDateTime;

@Entity
public class wl_users {

    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private int UserID;

    private String FirstName;

    private String LastName;

    private String Mail;

    private String RegistrationPassword;

    private String Pswd;

    private boolean IsAdmin;

    private String ResetPswd;

    @Temporal(TemporalType.TIMESTAMP)
    private LocalDateTime LastResetPswd;

}
