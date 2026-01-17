package com.eventia.demo.entidades;

import java.io.Serializable;
import jakarta.persistence.*;
import java.math.BigDecimal;
import java.util.List;


/**
 * The persistent class for the artista database table.
 * 
 */
@Entity
@NamedQuery(name="Artista.findAll", query="SELECT a FROM Artista a")
public class Artista implements Serializable {
	private static final long serialVersionUID = 1L;

	@Id
	private int id;

	@Column(name = "descripcion", columnDefinition = "TEXT")
	private String descripcion;

	@Column(name = "equipo_propio", columnDefinition = "TINYINT")
	private boolean equipoPropio;

	@Column(name="genero_musical")
	private String generoMusical;

	@Column(name="img_logo")
	private String imgLogo;

	@Column(name="nombre_artistico")
	private String nombreArtistico;

	@Column(name="num_integrantes")
	private int numIntegrantes;

	@Column(name="precio_referencia")
	private BigDecimal precioReferencia;

	@Column(name="recibir_facturas")
	private String recibirFacturas;

	private String telefono;

	private String tipo;

	//bi-directional many-to-one association to Usuario
	@ManyToOne
	@JoinColumn(name="id_usuario")
	private Usuario usuario;

	//bi-directional many-to-one association to Contratacion
	@OneToMany(mappedBy="artista")
	private List<Contratacion> contratacions;

	public Artista() {
	}

	public int getId() {
		return this.id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public String getDescripcion() {
		return this.descripcion;
	}

	public void setDescripcion(String descripcion) {
		this.descripcion = descripcion;
	}

	public boolean getEquipoPropio() {
		return this.equipoPropio;
	}

	public void setEquipoPropio(boolean equipoPropio) {
		this.equipoPropio = equipoPropio;
	}

	public String getGeneroMusical() {
		return this.generoMusical;
	}

	public void setGeneroMusical(String generoMusical) {
		this.generoMusical = generoMusical;
	}

	public String getImgLogo() {
		return this.imgLogo;
	}

	public void setImgLogo(String imgLogo) {
		this.imgLogo = imgLogo;
	}

	public String getNombreArtistico() {
		return this.nombreArtistico;
	}

	public void setNombreArtistico(String nombreArtistico) {
		this.nombreArtistico = nombreArtistico;
	}

	public int getNumIntegrantes() {
		return this.numIntegrantes;
	}

	public void setNumIntegrantes(int numIntegrantes) {
		this.numIntegrantes = numIntegrantes;
	}

	public BigDecimal getPrecioReferencia() {
		return this.precioReferencia;
	}

	public void setPrecioReferencia(BigDecimal precioReferencia) {
		this.precioReferencia = precioReferencia;
	}

	public String getRecibirFacturas() {
		return this.recibirFacturas;
	}

	public void setRecibirFacturas(String recibirFacturas) {
		this.recibirFacturas = recibirFacturas;
	}

	public String getTelefono() {
		return this.telefono;
	}

	public void setTelefono(String telefono) {
		this.telefono = telefono;
	}

	public String getTipo() {
		return this.tipo;
	}

	public void setTipo(String tipo) {
		this.tipo = tipo;
	}

	public Usuario getUsuario() {
		return this.usuario;
	}

	public void setUsuario(Usuario usuario) {
		this.usuario = usuario;
	}

	public List<Contratacion> getContratacions() {
		return this.contratacions;
	}

	public void setContratacions(List<Contratacion> contratacions) {
		this.contratacions = contratacions;
	}

	public Contratacion addContratacion(Contratacion contratacion) {
		getContratacions().add(contratacion);
		contratacion.setArtista(this);

		return contratacion;
	}

	public Contratacion removeContratacion(Contratacion contratacion) {
		getContratacions().remove(contratacion);
		contratacion.setArtista(null);

		return contratacion;
	}

}