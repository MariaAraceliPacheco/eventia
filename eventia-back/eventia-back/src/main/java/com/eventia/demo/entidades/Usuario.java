package com.eventia.demo.entidades;

import java.io.Serializable;
import jakarta.persistence.*;
import java.util.Date;
import java.util.List;


/**
 * The persistent class for the usuario database table.
 * 
 */
@Entity
@NamedQuery(name="Usuario.findAll", query="SELECT u FROM Usuario u")
public class Usuario implements Serializable {
	private static final long serialVersionUID = 1L;

	@Id
	private int id;

	private String email;

	@Temporal(TemporalType.TIMESTAMP)
	@Column(name="fecha_registro")
	private Date fechaRegistro;

	private String nombre;

	private String password;

	@Column(name="tipo_usuario")
	private String tipoUsuario;

	//bi-directional many-to-one association to Artista
	@OneToMany(mappedBy="usuario")
	private List<Artista> artistas;

	//bi-directional many-to-one association to Ayuntamiento
	@OneToMany(mappedBy="usuario")
	private List<Ayuntamiento> ayuntamientos;

	//bi-directional many-to-one association to Publico
	@OneToMany(mappedBy="usuario")
	private List<Publico> publicos;

	public Usuario() {
	}

	public int getId() {
		return this.id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public String getEmail() {
		return this.email;
	}

	public void setEmail(String email) {
		this.email = email;
	}

	public Date getFechaRegistro() {
		return this.fechaRegistro;
	}

	public void setFechaRegistro(Date fechaRegistro) {
		this.fechaRegistro = fechaRegistro;
	}

	public String getNombre() {
		return this.nombre;
	}

	public void setNombre(String nombre) {
		this.nombre = nombre;
	}

	public String getPassword() {
		return this.password;
	}

	public void setPassword(String password) {
		this.password = password;
	}

	public String getTipoUsuario() {
		return this.tipoUsuario;
	}

	public void setTipoUsuario(String tipoUsuario) {
		this.tipoUsuario = tipoUsuario;
	}

	public List<Artista> getArtistas() {
		return this.artistas;
	}

	public void setArtistas(List<Artista> artistas) {
		this.artistas = artistas;
	}

	public Artista addArtista(Artista artista) {
		getArtistas().add(artista);
		artista.setUsuario(this);

		return artista;
	}

	public Artista removeArtista(Artista artista) {
		getArtistas().remove(artista);
		artista.setUsuario(null);

		return artista;
	}

	public List<Ayuntamiento> getAyuntamientos() {
		return this.ayuntamientos;
	}

	public void setAyuntamientos(List<Ayuntamiento> ayuntamientos) {
		this.ayuntamientos = ayuntamientos;
	}

	public Ayuntamiento addAyuntamiento(Ayuntamiento ayuntamiento) {
		getAyuntamientos().add(ayuntamiento);
		ayuntamiento.setUsuario(this);

		return ayuntamiento;
	}

	public Ayuntamiento removeAyuntamiento(Ayuntamiento ayuntamiento) {
		getAyuntamientos().remove(ayuntamiento);
		ayuntamiento.setUsuario(null);

		return ayuntamiento;
	}

	public List<Publico> getPublicos() {
		return this.publicos;
	}

	public void setPublicos(List<Publico> publicos) {
		this.publicos = publicos;
	}

	public Publico addPublico(Publico publico) {
		getPublicos().add(publico);
		publico.setUsuario(this);

		return publico;
	}

	public Publico removePublico(Publico publico) {
		getPublicos().remove(publico);
		publico.setUsuario(null);

		return publico;
	}

}