package com.eventia.demo.entidades;

import java.io.Serializable;
import jakarta.persistence.*;
import java.util.Date;


/**
 * The persistent class for the contratacion database table.
 * 
 */
@Entity
@NamedQuery(name="Contratacion.findAll", query="SELECT c FROM Contratacion c")
public class Contratacion implements Serializable {
	private static final long serialVersionUID = 1L;

	@Id
	private int id;

	@Column(name="contrato_pdf")
	private String contratoPdf;

	@Temporal(TemporalType.DATE)
	@Column(name="fecha_contrato")
	private Date fechaContrato;

	//bi-directional many-to-one association to Evento
	@ManyToOne
	@JoinColumn(name="id_evento")
	private Evento evento;

	//bi-directional many-to-one association to Artista
	@ManyToOne
	@JoinColumn(name="id_artista")
	private Artista artista;

	public Contratacion() {
	}

	public int getId() {
		return this.id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public String getContratoPdf() {
		return this.contratoPdf;
	}

	public void setContratoPdf(String contratoPdf) {
		this.contratoPdf = contratoPdf;
	}

	public Date getFechaContrato() {
		return this.fechaContrato;
	}

	public void setFechaContrato(Date fechaContrato) {
		this.fechaContrato = fechaContrato;
	}

	public Evento getEvento() {
		return this.evento;
	}

	public void setEvento(Evento evento) {
		this.evento = evento;
	}

	public Artista getArtista() {
		return this.artista;
	}

	public void setArtista(Artista artista) {
		this.artista = artista;
	}

}