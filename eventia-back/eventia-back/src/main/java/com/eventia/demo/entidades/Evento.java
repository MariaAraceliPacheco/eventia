package com.eventia.demo.entidades;

import java.io.Serializable;
import jakarta.persistence.*;
import java.math.BigDecimal;
import java.util.Date;
import java.util.List;


/**
 * The persistent class for the evento database table.
 * 
 */
@Entity
@NamedQuery(name="Evento.findAll", query="SELECT e FROM Evento e")
public class Evento implements Serializable {
	private static final long serialVersionUID = 1L;

	@Id
	private int id;

	private String categoria;

	@Column(name = "descripcion", columnDefinition = "TEXT")
	private String descripcion;

	@Temporal(TemporalType.DATE)
	@Column(name="fecha_inicio")
	private Date fechaInicio;

	private String localidad;

	@Column(name="nombre_evento")
	private String nombreEvento;

	private BigDecimal precio;

	private String provincia;

	//bi-directional many-to-one association to Contratacion
	@OneToMany(mappedBy="evento")
	private List<Contratacion> contratacions;

	//bi-directional many-to-one association to Entrada
	@OneToMany(mappedBy="evento")
	private List<Entrada> entradas;

	//bi-directional many-to-one association to Ayuntamiento
	@ManyToOne
	@JoinColumn(name="id_ayuntamiento")
	private Ayuntamiento ayuntamiento;

	public Evento() {
	}

	public int getId() {
		return this.id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public String getCategoria() {
		return this.categoria;
	}

	public void setCategoria(String categoria) {
		this.categoria = categoria;
	}

	public String getDescripcion() {
		return this.descripcion;
	}

	public void setDescripcion(String descripcion) {
		this.descripcion = descripcion;
	}

	public Date getFechaInicio() {
		return this.fechaInicio;
	}

	public void setFechaInicio(Date fechaInicio) {
		this.fechaInicio = fechaInicio;
	}

	public String getLocalidad() {
		return this.localidad;
	}

	public void setLocalidad(String localidad) {
		this.localidad = localidad;
	}

	public String getNombreEvento() {
		return this.nombreEvento;
	}

	public void setNombreEvento(String nombreEvento) {
		this.nombreEvento = nombreEvento;
	}

	public BigDecimal getPrecio() {
		return this.precio;
	}

	public void setPrecio(BigDecimal precio) {
		this.precio = precio;
	}

	public String getProvincia() {
		return this.provincia;
	}

	public void setProvincia(String provincia) {
		this.provincia = provincia;
	}

	public List<Contratacion> getContratacions() {
		return this.contratacions;
	}

	public void setContratacions(List<Contratacion> contratacions) {
		this.contratacions = contratacions;
	}

	public Contratacion addContratacion(Contratacion contratacion) {
		getContratacions().add(contratacion);
		contratacion.setEvento(this);

		return contratacion;
	}

	public Contratacion removeContratacion(Contratacion contratacion) {
		getContratacions().remove(contratacion);
		contratacion.setEvento(null);

		return contratacion;
	}

	public List<Entrada> getEntradas() {
		return this.entradas;
	}

	public void setEntradas(List<Entrada> entradas) {
		this.entradas = entradas;
	}

	public Entrada addEntrada(Entrada entrada) {
		getEntradas().add(entrada);
		entrada.setEvento(this);

		return entrada;
	}

	public Entrada removeEntrada(Entrada entrada) {
		getEntradas().remove(entrada);
		entrada.setEvento(null);

		return entrada;
	}

	public Ayuntamiento getAyuntamiento() {
		return this.ayuntamiento;
	}

	public void setAyuntamiento(Ayuntamiento ayuntamiento) {
		this.ayuntamiento = ayuntamiento;
	}

}