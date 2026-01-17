package com.eventia.demo.dto.artistas;

import java.math.BigDecimal;

public class ArtistaInsertDTO {
	private int id_usuario;
	private String nombre_artistico;
	private String tipo;
	private String descripcion;
	private BigDecimal precio_referencia;
	private boolean equipo_propio;

	public ArtistaInsertDTO(int id_usuario, boolean equipo_propio, String nombre_artistico, String descripcion,
			String tipo, BigDecimal precio_referencia) {
		super();
		this.id_usuario = id_usuario;
		this.nombre_artistico = nombre_artistico;
		this.tipo = tipo;
		this.precio_referencia = precio_referencia;
		this.descripcion = descripcion;
		this.equipo_propio = equipo_propio;
	}

	public boolean isEquipo_propio() {
		return equipo_propio;
	}

	public void setEquipo_propio(boolean equipo_propio) {
		this.equipo_propio = equipo_propio;
	}

	public String getDescripcion() {
		return descripcion;
	}

	public void setDescripcion(String descripcion) {
		this.descripcion = descripcion;
	}

	public ArtistaInsertDTO() {
		super();
	}

	public int getId_usuario() {
		return id_usuario;
	}

	public void setId_usuario(int id_usuario) {
		this.id_usuario = id_usuario;
	}

	public String getNombre_artistico() {
		return nombre_artistico;
	}

	public void setNombre_artistico(String nombre_artistico) {
		this.nombre_artistico = nombre_artistico;
	}

	public String getTipo() {
		return tipo;
	}

	public void setTipo(String tipo) {
		this.tipo = tipo;
	}

	public BigDecimal getPrecio_referencia() {
		return precio_referencia;
	}

	public void setPrecio_referencia(BigDecimal precio_referencia) {
		this.precio_referencia = precio_referencia;
	}

}
