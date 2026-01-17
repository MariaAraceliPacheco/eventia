package com.eventia.demo.dto.artistas;

import java.math.BigDecimal;

public class EntradaInsertDTO {
	private int id_evento;
	private int id_publico;
	private String tipo_entrada;
	private BigDecimal precio;

	public EntradaInsertDTO(int id_evento, int id_publico, String tipo_entrada, BigDecimal precio) {
		super();
		this.id_evento = id_evento;
		this.id_publico = id_publico;
		this.tipo_entrada = tipo_entrada;
		this.precio = precio;
	}

	public EntradaInsertDTO() {
		super();
	}

	public int getId_evento() {
		return id_evento;
	}

	public void setId_evento(int id_evento) {
		this.id_evento = id_evento;
	}

	public int getId_publico() {
		return id_publico;
	}

	public void setId_publico(int id_publico) {
		this.id_publico = id_publico;
	}

	public String getTipo_entrada() {
		return tipo_entrada;
	}

	public void setTipo_entrada(String tipo_entrada) {
		this.tipo_entrada = tipo_entrada;
	}

	public BigDecimal getPrecio() {
		return precio;
	}

	public void setPrecio(BigDecimal precio) {
		this.precio = precio;
	}

}
