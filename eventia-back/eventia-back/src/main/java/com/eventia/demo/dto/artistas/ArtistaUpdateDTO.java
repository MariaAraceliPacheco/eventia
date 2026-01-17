package com.eventia.demo.dto.artistas;

import java.math.BigDecimal;

public class ArtistaUpdateDTO {
	private String nombre_artistico;
	private String tipo;
	private String genero_musical;
	private String descripcion;
	private BigDecimal precio_referencia;
	private Boolean equipo_propio;

	public ArtistaUpdateDTO(String nombre_artistico, String tipo, String genero_musical, String descripcion,
			BigDecimal precio_referencia, Boolean equipo_propio) {
		super();
		this.nombre_artistico = nombre_artistico;
		this.tipo = tipo;
		this.genero_musical = genero_musical;
		this.descripcion = descripcion;
		this.precio_referencia = precio_referencia;
		this.equipo_propio = equipo_propio;
	}

	public ArtistaUpdateDTO() {
		super();
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

	public String getGenero_musical() {
		return genero_musical;
	}

	public void setGenero_musical(String genero_musical) {
		this.genero_musical = genero_musical;
	}

	public String getDescripcion() {
		return descripcion;
	}

	public void setDescripcion(String descripcion) {
		this.descripcion = descripcion;
	}

	public BigDecimal getPrecio_referencia() {
		return precio_referencia;
	}

	public void setPrecio_referencia(BigDecimal precio_referencia) {
		this.precio_referencia = precio_referencia;
	}

	public Boolean getEquipo_propio() {
		return equipo_propio;
	}

	public void setEquipo_propio(Boolean equipo_propio) {
		this.equipo_propio = equipo_propio;
	}

}
