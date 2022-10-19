import {StyleSheet, Button, View, SafeAreaView, Text, Alert, Image} from 'react-native';
import React from 'react';

export const Profil = () => {
    return (
        <SafeAreaView>
            <View style={styles.container}>
               <Text>Mon profil</Text>
            </View>
        </SafeAreaView>
    )
}

const styles = StyleSheet.create({
    container: {
        borderRadius: 10,
        margin: 10,
        padding: 10,
    }
})