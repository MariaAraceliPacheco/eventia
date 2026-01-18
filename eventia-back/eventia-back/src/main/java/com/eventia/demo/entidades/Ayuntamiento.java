package com.eventia.demo.entidades;

import java.io.Serializable;
import jakarta.persistence.*;
import java.util.List;

import com.fasterxml.jackson.annotation.JsonIgnore;


/**
 * The persistent class for the ayuntamiento database table.
 * 
 */
@Entity
@NamedQuery(name="Ayuntamiento.findAll", query="SELECT a FROM Ayuntamiento a")
public class Ayuntamiento implements Serializable {
	private static final long serialVersionUID = 1L;

	@Id
	private int id;

	@Column(name="comunidad_autonoma")
	private String comunidadAutonoma;

	@Column(name="email_contacto")
	private String emailContacto;

	private String frecuencia;

	private String imagen;

	private String localidad;

	@Column(name="logistica_propia")
	private String logisticaPropia;

	@Column(name="nombre_institucion")
	private String nombreInstitucion;

	@Column(name="opciones_accesibilidad")
	private String opcionesAccesibilidad;

	private String provincia;

	private String telefono;

	@Column(name="tipo_espacio")
	private String tipoEspacio;

	@Column(name="tipo_evento")
	private String tipoEvento;

	@Column(name="tipo_facturacion")
	private String tipoFacturacion;

	//bi-directional many-to-one association to Usuario
	@ManyToOne
	@JoinColumn(name="id_usuario")
	private Usuario usuario;

	//bi-directional many-to-one association to Evento
	@OneToMany(mappedBy="ayuntamiento")
	@JsonIgnore
	private List<Evento> eventos;

	public Ayuntamiento() {
	}

	public int getId() {
		return this.id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public String getComunidadAutonoma() {
		return this.comunidadAutonoma;
	}

	public void setComunidadAutonoma(String comunidadAutonoma) {
		this.comunidadAutonoma = comunidadAutonoma;
	}

	public String getEmailContacto() {
		return this.emailContacto;
	}

	public void setEmailContacto(String emailContacto) {
		this.emailContacto = emailContacto;
	}

	public String getFrecuencia() {
		return this.frecuencia;
	}

	public void setFrecuencia(String frecuencia) {
		this.frecuencia = frecuencia;
	}

	public String getImagen() {
		return this.imagen;
	}

	public void setImagen(String imagen) {
		this.imagen = imagen;
	}

	public String getLocalidad() {
		return this.localidad;
	}

	public void setLocalidad(String localidad) {
		this.localidad = localidad;
	}

	public String getLogisticaPropia() {
		return this.logisticaPropia;
	}

	public void setLogisticaPropia(String logisticaPropia) {
		this.logisticaPropia = logisticaPropia;
	}

	public String getNombreInstitucion() {
		return this.nombreInstitucion;
	}

	public void setNombreInstitucion(String nombreInstitucion) {
		this.nombreInstitucion = nombreInstitucion;
	}

	public String getOpcionesAccesibilidad() {
		return this.opcionesAccesibilidad;
	}

	public void setOpcionesAccesibilidad(String opcionesAccesibilidad) {
		this.opcionesAccesibilidad = opcionesAccesibilidad;
	}

	public String getProvincia() {
		return this.provincia;
	}

	public void setProvincia(String provincia) {
		this.provincia = provincia;
	}

	public String getTelefono() {
		return this.telefono;
	}

	public void setTelefono(String telefono) {
		this.telefono = telefono;
	}

	public String getTipoEspacio() {
		return this.tipoEspacio;
	}

	public void setTipoEspacio(String tipoEspacio) {
		this.tipoEspacio = tipoEspacio;
	}

	public String getTipoEvento() {
		return this.tipoEvento;
	}

	public void setTipoEvento(String tipoEvento) {
		this.tipoEvento = tipoEvento;
	}

	public String getTipoFacturacion() {
		return this.tipoFacturacion;
	}

	public void setTipoFacturacion(String tipoFacturacion) {
		this.tipoFacturacion = tipoFacturacion;
	}

	public Usuario getUsuario() {
		return this.usuario;
	}

	public void setUsuario(Usuario usuario) {
		this.usuario = usuario;
	}

	public List<Evento> getEventos() {
		return this.eventos;
	}

	public void setEventos(List<Evento> eventos) {
		this.eventos = eventos;
	}

	public Evento addEvento(Evento evento) {
		getEventos().add(evento);
		evento.setAyuntamiento(this);

		return evento;
	}

	public Evento removeEvento(Evento evento) {
		getEventos().remove(evento);
		evento.setAyuntamiento(null);

		return evento;
	}

}