package com.eventia.demo.entidades;

import java.io.Serializable;
import jakarta.persistence.*;
import java.util.List;

import com.fasterxml.jackson.annotation.JsonIgnore;

/**
 * The persistent class for the publico database table.
 * 
 */
@Entity
@NamedQuery(name = "Publico.findAll", query = "SELECT p FROM Publico p")
public class Publico implements Serializable {
	private static final long serialVersionUID = 1L;

	@Id
	private int id;

	@Column(name = "comunidad_autonoma")
	private String comunidadAutonoma;

	@Column(name = "gustos_musicales")
	private String gustosMusicales;

	private String localidad;
	@Column(name = "notificaciones", columnDefinition = "TINYINT")
	private boolean notificaciones;

	private String provincia;

	@Column(name = "tipo_eventos_favoritos")
	private String tipoEventosFavoritos;

	// bi-directional many-to-one association to Entrada
	@OneToMany(mappedBy = "publico")
	@JsonIgnore
	private List<Entrada> entradas;

	// bi-directional many-to-one association to Usuario
	@ManyToOne
	@JoinColumn(name = "id_usuario") // aqui no se le pondria el JsonIgnore porque es obligatorio que publico esté
										// formado por un usuario
	private Usuario usuario;

	public Publico() {
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

	public String getGustosMusicales() {
		return this.gustosMusicales;
	}

	public void setGustosMusicales(String gustosMusicales) {
		this.gustosMusicales = gustosMusicales;
	}

	public String getLocalidad() {
		return this.localidad;
	}

	public void setLocalidad(String localidad) {
		this.localidad = localidad;
	}

	public boolean getNotificaciones() {
		return this.notificaciones;
	}

	public void setNotificaciones(boolean notificaciones) {
		this.notificaciones = notificaciones;
	}

	public String getProvincia() {
		return this.provincia;
	}

	public void setProvincia(String provincia) {
		this.provincia = provincia;
	}

	public String getTipoEventosFavoritos() {
		return this.tipoEventosFavoritos;
	}

	public void setTipoEventosFavoritos(String tipoEventosFavoritos) {
		this.tipoEventosFavoritos = tipoEventosFavoritos;
	}

	public List<Entrada> getEntradas() {
		return this.entradas;
	}

	public void setEntradas(List<Entrada> entradas) {
		this.entradas = entradas;
	}

	public Entrada addEntrada(Entrada entrada) {
		getEntradas().add(entrada);
		entrada.setPublico(this);

		return entrada;
	}

	public Entrada removeEntrada(Entrada entrada) {
		getEntradas().remove(entrada);
		entrada.setPublico(null);

		return entrada;
	}

	public Usuario getUsuario() {
		return this.usuario;
	}

	public void setUsuario(Usuario usuario) {
		this.usuario = usuario;
	}

}