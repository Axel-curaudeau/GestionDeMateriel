package org.example;

import jakarta.persistence.Entity;
import jakarta.persistence.Id;

@Entity
public class wl_equipment {

    @Id
    private String Reference;
    private String Name;
    private String Version;
    private String phoneNumber;
}
