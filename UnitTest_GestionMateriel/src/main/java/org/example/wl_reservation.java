package org.example;

import jakarta.persistence.Entity;
import jakarta.persistence.Id;
import jakarta.persistence.Temporal;
import jakarta.persistence.TemporalType;

import java.util.Date;

@Entity
public class wl_reservation {

    @Id
    private int ReservationID;

    @Temporal(TemporalType.DATE)
    private Date BeginDate;

    @Temporal(TemporalType.DATE)
    private Date EndDate;

    private int UserID;

    private String Reference;
}
