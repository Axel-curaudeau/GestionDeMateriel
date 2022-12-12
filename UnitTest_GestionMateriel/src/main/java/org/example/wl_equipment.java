package org.example;

import jakarta.persistence.Entity;
import jakarta.persistence.Id;

@Entity
public class wl_equipment {

    @Id
    private String Reference;
    private String Name;
    private String Version;
    private String PhoneNumber;

    public wl_equipment(String Reference, String Name, String Version, String PhoneNumber) {
        this.Reference = Reference;
        this.Name = Name;
        this.Version = Version;
        this.PhoneNumber = PhoneNumber;
    }

    public wl_equipment() {

    }
}
